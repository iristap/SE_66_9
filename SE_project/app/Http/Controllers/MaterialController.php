<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    function index(){
        // $material=DB::table('material')->get();
        $material = Material::getAll();
        return view('material.index', compact('material'));
    }
    public function destroy($material): RedirectResponse
    {
        Material::where('material_id', $material)->delete();
        return redirect()->route('material.index')
            ->with('success', ' Deleted successfully');
    }
    
}