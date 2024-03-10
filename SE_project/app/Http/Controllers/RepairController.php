<?php

namespace App\Http\Controllers;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller {
    function index(){
        $repairs = DB::table('repair_list')
        ->select('repair_list.*', 'durable_articles.name')
        ->join('durable_articles', 'repair_list.durable_articles_id', '=', 'durable_articles.durable_articles_id')
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
            ->select('borrowing.*', 'durable_articles.*', 'sender.name as sender_name')
            ->first();
        return view('repair.show', compact('repair'));
    }
}