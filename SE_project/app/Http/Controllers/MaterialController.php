<?php

namespace App\Http\Controllers;
use App\Models\Material;


class MaterialController extends Controller
{
    function index(){
        // $material=DB::table('material')->get();
        $material = Material::getAll();
        return view('material.index', compact('material'));
    }
    
}