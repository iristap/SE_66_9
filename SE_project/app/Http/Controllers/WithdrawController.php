<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Event\Test\Prepared;
use App\Http\Controllers\Controller;


class WithdrawController extends Controller
{
    public function index()
    {
        $material = DB::table('material')->get();
        return view('withdraw.withdraw', compact('material'));
    }

    public function disbursement_detail(Request $request)
    {
        $request->validate([
            'material_id' => 'required|array|min:1',
        ],);
        $user = Auth::user();
        $selectedMaterialIds = $request->input('material_id');
        $selectedMaterials = Material::whereIn('material_id', $selectedMaterialIds)->get();

        return view('withdraw.disbursement_detail', compact('selectedMaterials', 'user'));
    }

}

