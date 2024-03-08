<?php

namespace App\Http\Controllers;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller {
    function index(){
        $repair=DB::table('repair_list')->get();
        return view('repair', compact('repair'));
    }

    public function showRepair() {
        return $this->index();
    }
}