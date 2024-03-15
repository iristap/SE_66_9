<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class WithdrawController extends Controller
{
    public function index()
    {
        $material = DB::table('material')->get();
        return view('withdraw.withdraw', compact('material'));
    }

    public function listwd(Request $request)
    {
        $request->validate([
            'material_id' => 'required|array|min:1',
        ],);
        $user = Auth::user();
        $selectedMaterialIds = $request->input('material_id');
        $selectedMaterial = Material::whereIn('material_id', $selectedMaterialIds)->get();

        return view('withdraw.listwd', compact('selectedMaterial','user'));
    }
}
