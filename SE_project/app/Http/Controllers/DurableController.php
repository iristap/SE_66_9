<?php

namespace App\Http\Controllers;
use App\Models\DA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DurableController extends Controller
{
    
    function index(){
        $durable=\DB::table('durable_articles')->get();
        // foreach ($durable as $durable) {
        //     echo $durable->durable_articles_id;
            
        //     echo $durable->durable_articles_code;
            
        //     echo $durable->name;
            
        //     echo $durable->status;
        //     echo " | ";
        //     echo "<br>";
        // }
        // while($my_row=$$durable->fetch_assoc()){

        // }
        return view('durable', compact('durable'));
        
    }
    public function showDurable(){
        $durable=DB::table('durable_articles')->get();
        return view('durable', compact('durable'));
    }
}