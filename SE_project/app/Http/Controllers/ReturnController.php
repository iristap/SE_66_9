<?php

namespace App\Http\Controllers;
use App\Models\Borrowing_list;
use App\Models\Borrowing;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller {
    function index(){
        $returns = Borrowing::with(['borrowingLists.durable'])
        ->where('status', 'พิจารณาแล้ว')
        ->whereHas('borrowingLists.durable', function($query) {
            $query->where('condition_status', 'ปกติ');
        })
        ->get();
        return view('return.index', compact('returns'));
    }
    

    public function show($id)
    {
        $borrowingLists = Borrowing_list::where('borrowing_id', $id)
                            ->whereHas('durable', function ($query) {
                                $query->where('availability_status', 'ไม่พร้อมใช้งาน')
                                      ->where('condition_status', 'ปกติ');
                            })
                            ->get();
        $borrowings = Borrowing::findOrFail($id); 
        $durables = $borrowingLists->load(['durable']);
        
        return view('return.show', compact('borrowingLists', 'borrowings', 'durables'));
    }
    

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $borrowingList = Borrowing_list::findOrFail($id);
        $borrowing = $borrowingList->borrowing;
        $durable = $borrowingList->durable;
        $status = $request->input('status');
        if($status === 'ปกติ'){
            foreach ($durable->borrowingList as $borrowingList) {
                $borrowing = $borrowingList->borrowing;
                $borrowing->return_date= date('Y-m-d');
                $borrowing->save();
            }
            $durable->availability_status = 'พร้อมใช้งาน';
            $durable->save();
            // DB::table('borrowing_list')
            // ->join('borrowing', 'borrowing_list.borrowing_id', '=', 'borrowing.borrowing_id')
            // ->where('borrowing_list.borrowing_list_id', $id)
            // ->delete();
        } else if($status === 'ชำรุด'){
            foreach ($durable->borrowingList as $borrowingList) {
                $borrowing = $borrowingList->borrowing;
                $borrowing->return_date= date('Y-m-d');
                $borrowing->save();
            }
            $durable->condition_status = 'ชำรุด';
            $durable->save();
            $damagedDurable = new Repair();
            $damagedDurable->durable_articles_id = $durable->durable_articles_id;
            $damagedDurable->durable_articles_name = $durable->name;
            $damagedDurable->inspector_name = 'technician';
            $damagedDurable->status = $status;
            $damagedDurable->detail = $request->input('detail');
            $damagedDurable->save();
        } else if($status === 'หาย'){
            foreach ($durable->borrowingList as $borrowingList) {
                $borrowing = $borrowingList->borrowing;
                $borrowing->return_date= date('Y-m-d');
                $borrowing->save();
            }
            $durable->condition_status = 'หาย';
            $durable->save();
        }
        $borrowing->id_checker = Auth::id();
        $borrowing->save();
        
        return redirect()->route('return.show', ['id' => $borrowing->borrowing_id]);
    }
}
