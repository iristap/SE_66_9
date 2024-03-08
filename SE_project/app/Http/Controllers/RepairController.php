<?php

namespace App\Http\Controllers;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller {
    function index(){
        $repair = DB::table('repair_list')
        ->select('repair_list.*', 'durable_articles.name')
        ->join('durable_articles', 'repair_list.durable_articles_id', '=', 'durable_articles.durable_articles_id')
        ->get();
        return view('repair', compact('repair'));
    }

    public function showRepair() {
        return $this->index();
    }
}