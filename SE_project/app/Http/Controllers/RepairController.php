<?php

namespace App\Http\Controllers;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller {
    function index(){
        $repairs = Repair::with('durable')
                    ->where('status', 'ชำรุด')
                    ->get();
        return view('repair.index', compact('repairs'));
    }

    public function show($no)
    {
        $repair = Repair::with('durable.borrowingList.borrowing.sender')
                    ->where('no', $no)
                    ->first();
                    $durable = $repair->durable;
                    $borrowingLists = $durable->borrowingList;
        return view('repair.show', compact('repair'));
    }

    public function update(Request $request, $no)
    {
        $repair = Repair::findOrFail($no);
        $status = $request->input('status');
        $durable = $repair->durable;
        $borrowingLists = $durable->borrowingList;
        if ($status === 'ปกติ') {
            $durable->availability_status = 'ว่าง';
            $durable->condition_status = 'ปกติ';
            $repair->status = $status;
        }else if($status === 'ไม่สามารถซ่อมได้') {
            $durable->availability_status = 'ไม่ว่าง';
            $repair->status = $status;
        }
        $durable->save();
        $repair->save();
        foreach ($durable->borrowingList as $borrowingList) {
            $borrowing = $borrowingList->borrowing;
            $borrowing->delete();
        }
        foreach ($durable->borrowingList as $borrowingList) {
            $borrowingList->delete();
        }
        return redirect()->route('repair.index');
    }

    public function history()
    {
        $repairs = Repair::with('durable')
            ->whereIn('status', ['ปกติ', 'ไม่สามารถซ่อมได้'])
            ->get();
        return view('repair.history', compact('repairs'));
    }
}