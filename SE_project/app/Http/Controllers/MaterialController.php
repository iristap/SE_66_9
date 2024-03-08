<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Material;


class MaterialController extends Controller
{
    function index(){
        // $material=DB::table('material')->get();
        $material = Material::getAll();
        return view('material', compact('material'));
    }
    
}