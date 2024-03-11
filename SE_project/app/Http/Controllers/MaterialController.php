<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit(Request $request, $id){
        $material=\DB::table('material')->where('material_id', $id)->first();
        return view('material.edit', compact('material'));
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                'name'=>'required|max:20',
                'amount'=>'required|max:8',
                'unit'=>'required|max:20'
            ],
            [
                'name.required'=>'โปรดป้อนชื่อวัสดุ',
                'name.max'=>'ชื่อวัสดุไม่ควรเกิน 20 ตัวอักษร',
                'amount.required'=>'โปรดป้อนจำนวนของวัสดุ',
                'amount.max'=>'ชื่อวัสดุไม่ควรเกิน 8 ตัวอักษร',
                'unit.required'=>'โปรดป้อนหน่วยนับของวัสดุ',
                'unit.max'=>'ชื่อวัสดุไม่ควรเกิน 20 ตัวอักษร',
            ]
            );
            $data=[
                'name'=>$request->name,
                'amount'=>$request->amount,
                'unit'=>$request->unit
            ];
            DB::table('material')->where('material_id', $id)->update($data);
            return redirect('/material');
    }

    

    
}