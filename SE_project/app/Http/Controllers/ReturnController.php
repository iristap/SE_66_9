<?php

namespace App\Http\Controllers;
use App\Models\Borrowing_list;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller {
    function index(){
        $returns = Borrowing_list::with(['borrowing','durable'])
        ->whereHas('borrowing', function($query) {
            $query->where('status', 'ปกติ');
        })
        ->whereHas('durable', function($query) {
            $query->where('availability_status', 'ถูกยืม');
        })
        ->get();
        return view('return.index', compact('returns'));
    }

    public function show($id)
    {
        $borrowingList = Borrowing_list::findOrFail($id);
        $borrowing = $borrowingList->borrowing;
        $durable = $borrowingList->durable;
    
        return view('return.show', compact('borrowingList', 'borrowing', 'durable'));
    }

    public function update(Request $request, $id)
    {
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
            $durable->availability_status = 'ว่าง';
            $durable->save();
            DB::table('borrowing_list')
            ->join('borrowing', 'borrowing_list.borrowing_id', '=', 'borrowing.borrowing_id')
            ->where('borrowing_list.borrowing_list_id', $id)
            ->delete();
        } else if($status === 'ชำรุด'){
            foreach ($durable->borrowingList as $borrowingList) {
                $borrowing = $borrowingList->borrowing;
                $borrowing->status = $status;
                $borrowing->return_date= date('Y-m-d');
                $borrowing->save();
            }
            $durable->availability_status = 'ไม่ว่าง';
            $damagedDurable = new Repair();
            $damagedDurable->durable_articles_id = $durable->durable_articles_id;
            $damagedDurable->durable_articles_name = $durable->name;
            $damagedDurable->inspector_name = '';
            $damagedDurable->status = $status;
            $damagedDurable->detail = $request->input('detail');
            $damagedDurable->save();
        } else if($status === 'หาย'){
            foreach ($durable->borrowingList as $borrowingList) {
                $borrowing = $borrowingList->borrowing;
                $borrowing->status = $status;
                $borrowing->return_date= date('Y-m-d');
                $borrowing->save();
            }
            $durable->availability_status = 'ไม่ว่าง';
            $durable->condition_status = 'หาย';
            $durable->save();
        }
        
        return redirect()->route('return.index');
    }
}
