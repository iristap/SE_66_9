<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\Auth;
use App\Models\Durable;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $onlyB = Borrowing::getOnlyB();

        return view('borrowing.index',compact('borrowing','onlyB'));
    }

    public function considered(Request $request): View
    {
        $borrowing =  Borrowing::getAll();
        $onlyB = Borrowing::getOnlyB();

        return view('borrowing.considered',compact('borrowing','onlyB'));
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

    public function detailsC(Request $request): View
    {
        $borrowingId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $brlItem = Borrowing_list::where('borrowing_id', $borrowingId)->first();
        $br_user = Borrowing_list::getUserName($borrowingId);
        $br_da = Borrowing_list::getDurable($borrowingId);

        return view('borrowing.detailsC', compact('brlItem','br_user','br_da'));

    }

    public function approved(Request $request): View
    {
        $borrowingId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $br = Borrowing::where('borrowing_id', $borrowingId)->first();

        return view('borrowing.approved', compact('br','borrowingId'));

    }

    public function a_update($id, $da_id){
            $data=[
                'id_approver'=>auth()->id(),
                'approved_date'=>now()
            ];
            $data2=[
                'status_approved'=>'อนุมัติแล้ว'
            ];
            DB::table('borrowing')
            ->where('borrowing_id', $id)
            ->update($data);

            DB::table('borrowing_list')
            ->where('durable_articles_id', $da_id)
            ->where('borrowing_id', $id)
            ->update($data2);

            return redirect('/borrowing/details/' . $id);
    }

    public function not_approved($bid,$da_id): View
    {
        $br = Borrowing_list::getEachDur($bid,$da_id);

        return view('borrowing.not_approved', compact('br','bid','da_id'));
    }

    public function na_update(Request $request,$bid, $da_id){
        $request->validate(
            [
                'not_approved_note'=>'required',
            ],
            [
                'not_approved_note.required'=>'โปรดป้อนหมายเหตุการไม่อนุมัติ',
            ]
            );
        $data=[
            'id_approver'=>auth()->id(),
            'approved_date'=>now(),
        ];
        $data2=[
            'status_approved'=>'ไม่อนุมัติ',
            'not_approved_note'=>$request->not_approved_note
        ];
        DB::table('borrowing')
        ->where('borrowing_id', $bid)
        ->update($data);

        DB::table('borrowing_list')
        ->where('durable_articles_id', $da_id)
        ->where('borrowing_id', $bid)
        ->update($data2);

        return redirect('/borrowing/details/' . $bid);
    }




}
