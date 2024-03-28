<?php

namespace App\Http\Controllers;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller {
    function index(){
        $repairs = Repair::where('status', 'ชำรุด')->get();
        return view('repair.index', compact('repairs'));
    }

    public function show($no)
    {
        $repair = Repair::where('no', $no)->first();
        $durable = $repair->durable;
        $borrowingList = $repair->borrowingList;
        $borrowing = $borrowingList->borrowing;
        $sender = $borrowing->sender;
        return view('repair.show', compact('repair','sender'));
    }

    public function update(Request $request, $no)
    {
        $repair = Repair::findOrFail($no);
        $status = $request->input('status');
        $user = Auth::user();
        $durable = $repair->durable;
        if ($status === 'ปกติ') {
            $durable->availability_status = 'พร้อมใช้งาน';
            $durable->condition_status = 'ปกติ';
        }else if($status === 'ไม่สามารถซ่อมได้') {
            $durable->availability_status = 'ไม่พร้อมใช้งาน';
            $durable->condition_status = 'ชำรุด';
        }
        $repair->status = $status;
        $repair->inspector_name = $user->name;
        $durable->save();
        $repair->save();
        // foreach ($durable->borrowingList as $borrowingList) {
        //     $borrowing = $borrowingList->borrowing;
        //     $borrowing->delete();
        // }
        // foreach ($durable->borrowingList as $borrowingList) {
        //     $borrowingList->delete();
        // }
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