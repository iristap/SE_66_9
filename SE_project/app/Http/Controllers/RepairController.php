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
        $repair = DB::table('repair_list')
            ->join('durable_articles', 'repair_list.durable_articles_id', '=', 'durable_articles.durable_articles_id')
            ->join('borrowing_list', 'durable_articles.durable_articles_id', '=', 'borrowing_list.durable_articles_id')
            ->join('borrowing', 'borrowing_list.borrowing_id', '=', 'borrowing.borrowing_id')
            ->join('users as sender', 'borrowing.id_sender', '=', 'sender.id')
            ->where('repair_list.no', $no)
            ->select('repair_list.no','borrowing.*', 'durable_articles.*', 'sender.name as sender_name')
            ->first();
        return view('repair.show', compact('repair'));
    }

    public function update(Request $request, $no)
    {
        $repair = Repair::findOrFail($no);
        $status = $request->input('status');
        $durable = $repair->durable;
        if ($status === 'ปกติ') {
            $durable->status = 'ว่าง';
            $repair->status = $status;
        }else if($status === 'ไม่สามารถซ่อมได้') {
            $durable->status = 'ไม่ว่าง';
            $repair->status = $status;
        }
        DB::table('repair_list')
        ->join('durable_articles', 'repair_list.durable_articles_id', '=', 'durable_articles.durable_articles_id')
        ->join('borrowing_list', 'durable_articles.durable_articles_id', '=', 'borrowing_list.durable_articles_id')
        ->join('borrowing', 'borrowing_list.borrowing_id', '=', 'borrowing.borrowing_id')
        ->where('repair_list.no', $no)
        ->update(['borrowing.status' => $status]);    
        
        $durable->save();
        $repair->save();
        return redirect()->route('repair.index');
    }

    public function history()
    {
        $repairs = DB::table('borrowing_list')
            ->join('durable_articles', 'durable_articles.durable_articles_id', '=', 'borrowing_list.durable_articles_id')
            ->join('borrowing', 'borrowing_list.borrowing_id', '=', 'borrowing.borrowing_id')
            ->join('repair_list', function ($join) {
                $join->on('repair_list.durable_articles_id', '=', 'durable_articles.durable_articles_id')
                    ->whereColumn('borrowing.status', '=', 'repair_list.status');
            })
            ->select('borrowing.status', 'durable_articles.name', 'durable_articles.durable_articles_code', 'repair_list.inspector_name')
            ->get();
        return view('repair.history', compact('repairs'));
    }
}