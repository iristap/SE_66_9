<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\Auth;
use App\Models\Durable;
use App\Models\User;
use DB;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Borrowing_list;
use App\Models\Borrowing;
use App\Models\Users_br;

class BorrowingController extends Controller
{
    public function index(Request $request): View
    {
        $borrowing =  Borrowing::getAll();

        return view('borrowing.index',compact('borrowing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrowing_note' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $borrowing = new Borrowing();
        $borrowing->borrow_date = now();
        $borrowing->borrowing_note = $request->input('borrowing_note');
        $borrowing->status = 'ปกติ';
        $borrowing->id_sender = $user->id;
        $borrowing->save();
        $selectedDurableIds = $request->input('durable_articles_id');
        foreach ($selectedDurableIds as $durableId) {
            $durable = Durable::findOrFail($durableId);
            $durable->status = 'ไม่ว่าง';
            $durable->save();
            $borrowingList = new Borrowing_list();
            $borrowingList->borrowing_id = $borrowing->id;
            $borrowingList->durable_articles_id = $durableId;
            $borrowingList->save();
        }
        return redirect()->route('borrowing.index')->with('success', 'Borrowing successful!');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'durable_articles_id' => 'required|array|min:1',
        ],);
        $user = Auth::user();
        $selectedDurableIds = $request->input('durable_articles_id');
        $selectedDurables = Durable::whereIn('durable_articles_id', $selectedDurableIds)->get();
        return view('borrowing.confirm', compact('selectedDurables','user'));
    }

    public function details(Request $request): View
    {
        $borrowingId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $brlItem = Borrowing_list::where('borrowing_id', $borrowingId)->first();
        $br_user = Borrowing_list::getUserName($borrowingId);
        $br_da = Borrowing_list::getDurable($borrowingId);

        return view('borrowing.details', compact('brlItem','br_user','br_da'));

    }

    public function approved(Request $request): View
    {
        $borrowingId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $br = Borrowing::where('borrowing_id', $borrowingId)->first();

        return view('borrowing.approved', compact('br','borrowingId'));

    }
    public function a_update(Request $request, $id){
            $request->validate(
                [
                    'id_approver'=>'required|max:5',
                    'approved_date'=>'required'
                ],
                [
                    'id_approver'=>'กรุณาใส่ ID ผู้อนุมัติ',
                    'approved_date.required'=>'กรุณากรอกวันที่อนุมัติ'
                ]
            );
            $data=[
                'id_approver'=>$request->id_approver,
                'approved_date'=>$request->approved_date,
                'status'=>$request->status
            ];
            DB::table('borrowing')->where('borrowing_id', $id)->update($data);
            return redirect('/borrowing');
    }

    public function not_approved(Request $request): View
    {
        $borrowingId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $br = Borrowing::getID($borrowingId);
        $apper = Borrowing::getApper($borrowingId);

        return view('borrowing.not_approved', compact('br','borrowingId','apper'));
    }




}
