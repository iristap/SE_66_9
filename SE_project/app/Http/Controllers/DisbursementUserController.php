<?php

namespace App\Http\Controllers;

use App\Models\Durable;
use App\Models\Disbursement;
use App\Models\Disbursement_detail;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisbursementUserController extends Controller
{
    public function index()
    {
        $material = DB::table('material')->get();
        return view('withdraw.index_user', compact('material'));
    }
    public function confirm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'material_id' => 'required|array|min:1',
            'amount_selected' => 'required|array|min:1',
        ],);
        $user = Auth::user();
        $selectedMaterialIds = $request->input('material_id');
        $amount_selected = $request->input('amount_selected');
        $selectedMaterials = Material::whereIn('material_id', $selectedMaterialIds)->get();
        $nonZeroAmounts = array_values(array_filter($amount_selected, function ($amount) {
            return $amount > 0;
        }));
        $material_list = new disbursement_detail();
        foreach ($selectedMaterials as $item) {
            // Process each $amount here
        }
        return view('withdraw.confirm_user', compact('selectedMaterials', 'user', 'amount_selected' ,'nonZeroAmounts'));
    }

    //v1
    //     public function store(Request $request)
    //     {
    //         // dd($request->all());
    //         $request->validate([
    //    //         'note_disbursement' => 'required|string|max:255',
    //             'material_id' => 'required|array|min:1',
    //             'amount_selected' => 'required|array|min:1',
    //             // 'note_disbursement' => 'required|string|max:255',
    //         ]);

    //         $user = Auth::user();
    //         $disbursement = new Disbursement();
    //         $disbursement->date_disbursement = now();
    //         $disbursement->note_disbursement = $request->input('note_disbursement');
    //         $disbursement->amount;
    //         $disbursement->user_id = $user->id;
    //         $disbursement->status='รออนุมัติ';

    //         $disbursement->save();
    //         $selectedMaterialIds = $request->input('material_id');

    //         // foreach ($selectedMaterialIds as $material_id) {
    //         //     //$material = Material::findOrFail($material_id);
    //         //     $material = Material::where('material_id', $material_id)->firstOrFail();
    //         //     $amount_selected = $request->input('amount_selected');
    //         //     $material->amount -= $amount_selected;
    //         //     //$material->amount = 'amount';
    //         //     $material->save();
    //         //     $disbursementlist = new Disbursement_detail();
    //         //     $disbursementlist->disbursement_id = $disbursement->id;
    //         //     $disbursementlist->material_id = $material_id;
    //         //     $disbursementlist->amount = $amount_selected;
    //         //     $disbursementlist->save();
    //         // }
    //         $amount_selected = $request->input('amount_selected'); // ดึงอาร์เรย์ของค่าจำนวนที่เลือกมา

    //         foreach ($selectedMaterialIds as $key => $material_id) {
    //             $material = Material::where('material_id', $material_id)->firstOrFail();

    //             // ตรวจสอบว่าค่าจำนวนที่เลือกมามีอยู่จริงหรือไม่
    //             if (isset($amount_selected[$key])) {
    //                 $selectedAmount = $amount_selected[$key]; // นำค่าจำนวนที่เลือกมา
    //             } else {
    //                 $selectedAmount = 0; // หากไม่มีให้กำหนดค่าเป็น 0
    //             }

    //             // ลบค่าจำนวนที่เลือกมาจากวัสดุ
    //             $material->amount -= $selectedAmount;
    //             $material->save();

    //             // บันทึกข้อมูลรายละเอียดการเบิก
    //             $disbursementlist = new Disbursement_detail();
    //             $disbursementlist->disbursement_id = $disbursement->id;
    //             $disbursementlist->material_id = $material_id;
    //             $disbursementlist->amount = $selectedAmount;
    //             $disbursementlist->save();
    //         }

    //         return redirect()->route('withdraw.index_user')->with('success', 'withdraw successful!');
    //    }
    //v2
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'material_id' => 'required|array|min:1',
    //         'amount' => 'required|array|min:1',
    //         'note_disbursement' => 'required|string|max:255',
    //     ]);

    //     $user = Auth::user();
    //     $disbursement = new Disbursement();
    //     $disbursement->date_disbursement = now();
    //     $disbursement->note_disbursement = $request->input('note_disbursement');
    //     $disbursement->user_id = $user->id;
    //     $disbursement->status = 'รออนุมัติ';
    //     $disbursement->save();

    //     $selectedMaterialIds = $request->input('material_id');
    //     $amountSelected = $request->input('amount_selected');

    //     foreach ($selectedMaterialIds as $key => $materialId) {
    //         $material = Material::find($materialId);
    //         if ($material) {
    //             $amount = $amountSelected[$key];
    //             $material->amount -= $amount;
    //             $material->save();

    //             $disbursementDetail = new Disbursement_detail();
    //             $disbursementDetail->disbursement_id = $disbursement->id;
    //             $disbursementDetail->material_id = $materialId;
    //             $disbursementDetail->amount = $amount;
    //             $disbursementDetail->save();
    //         }
    //     }

    //     return redirect()->route('withdraw.index_user')->with('success', 'Withdraw successful!');
    // }
    //v3
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'material_id' => 'required|array|min:1',
    //         'amount_selected' => 'required|array|min:1',
    //     ]);

    //     $user = Auth::user();
    //     $disbursement = new Disbursement();
    //     $disbursement->date_disbursement = now();
    //     $disbursement->note_disbursement = $request->input('note_disbursement');
    //     $disbursement->user_id = $user->id;
    //     $disbursement->status = 'รออนุมัติ';
    //     $disbursement->save();

    //     $selectedMaterialIds = $request->input('material_id');
    //     $amountSelected = $request->input('amount_selected'); // เปลี่ยนชื่อตรงนี้เป็น amountSelected ตามการตั้งชื่อในฟอร์ม

    //     foreach ($selectedMaterialIds as $key => $materialId) {
    //         $material = Material::find($materialId);
    //         if ($material) {
    //             $amount = $amountSelected[$key];
    //             // $material->amount -= $amount;
    //             $material->save();

    //             $disbursementDetail = new Disbursement_detail();
    //             $disbursementDetail->disbursement_id = $disbursement->id;
    //             $disbursementDetail->material_id = $materialId;
    //             $disbursementDetail->amount = $amount;
    //             $disbursementDetail->save();
    //         }
    //     }

    //     return redirect()->route('withdraw.index_user')->with('success', 'Withdraw successful!');
    // }
    //v4
    //v1
    //     public function store(Request $request)
    //     {
    //         $request->validate([
    //    //         'note_disbursement' => 'required|string|max:255',
    //             'material_id' => 'required|array|min:1',
    //             'amount_selected' => 'required|array|min:1',
    //             'note_disbursement' => 'required|string|max:255',
    //         ]);
    //         $user = Auth::user();
    //         $disbursement = new Disbursement();
    //         $disbursement->date_disbursement = now();
    //         $disbursement->note_disbursement = $request->input('note_disbursement');
    //         $disbursement->amount;
    //         $disbursement->user_id = $user->id;
    //         $disbursement->status='รออนุมัติ';
    //         $disbursement->save();

    //         $selectedMaterialIds = $request->input('material_id');
    //         $amountSelected = $request->input('amount_selected');
    //         foreach ($selectedMaterialIds as $key => $material_id) {
    //             $amount_selected = $amountSelected[$key];

    //             $material = Material::findOrFail($material_id);
    //             $material->amount -= $amount_selected;
    //             $material->save();
    //             //$material = Material::findOrFail($material_id);
    //             // $material = Material::where('material_id', $material_id)->firstOrFail();
    //             // $amount_selected = $request->input('amount_selected');
    //             // $material->amount -= $amount_selected;
    //             // //$material->amount = 'amount';
    //             // $material->save();
    //             $disbursementlist = new Disbursement_detail();
    //             $disbursementlist->disbursement_id = $disbursement->id;
    //             $disbursementlist->material_id = $material_id;
    //             $disbursementlist->amount = $amount_selected;
    //             $disbursementlist->save();
    //         }
    //         return redirect()->route('withdraw.index_user')->with('success', 'withdraw successful!');
    //     }
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'material_id' => 'required|array|min:1',
    //         'amount_selected' => 'required|array|min:1',
    //     ]);

    //     $user = Auth::user();

    //     // Create a new Disbursement record
    //     $disbursement = new Disbursement();
    //     $disbursement->date_disbursement = now();
    //     $disbursement->note_disbursement = $request->input('note_disbursement');
    //     $disbursement->user_id = $user->id;
    //     $disbursement->status = 'รออนุมัติ';
    //     $disbursement->save();

    //     // Process each selected material
    //     $selectedMaterialIds = $request->input('material_id');
    //     $amountsSelected = $request->input('amount_selected');
    //     foreach ($selectedMaterialIds as $key => $material_id) {
    //         $material = Material::where('material_id', $material_id)->firstOrFail(); // Find material by material_id
    //         if ($material) {
    //             $amount_selected = $amountsSelected[$key]; // Get the corresponding selected amount
    //             $material->amount -= $amount_selected; // Subtract the selected amount from the material's amount
    //             $material->save();

    //             // Create a new Disbursement_detail record
    //             $disbursementDetail = new Disbursement_detail();
    //             $disbursementDetail->disbursement_id = $disbursement->id;
    //             $disbursementDetail->material_id = $material_id;
    //             $disbursementDetail->amount = $amount_selected;
    //             $disbursementDetail->save();
    //         } else {
    //             // Handle the case where the material is not found
    //             // You may want to log this or handle it differently based on your application logic
    //         }
    //     }

    //     return redirect()->route('withdraw.index_user')->with('success', 'withdraw successful!');
    // }
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'material_id' => 'required|array|min:1',
    //         'amount_selected' => 'required|array|min:1',
    //     ]);

    //     $user = Auth::user();

    //     // Create a new Disbursement record
    //     $disbursement = new Disbursement();
    //     $disbursement->date_disbursement = now();
    //     $disbursement->note_disbursement = $request->input('note_disbursement');
    //     $disbursement->user_id = $user->id;
    //     $disbursement->status = 'รออนุมัติ';
    //     $disbursement->save();

    //     // Process each selected material
    //     $selectedMaterialIds = $request->input('material_id');
    //     $amountsSelected = $request->input('amount_selected');
    //     foreach ($selectedMaterialIds as $key => $material_id) {
    //         $material = Material::where('material_id', $material_id)->first(); // Find material by material_id
    //         if ($material) {
    //             $amount_selected = $amountsSelected[$key]; // Get the corresponding selected amount
    //             $material->amount -= $amount_selected; // Subtract the selected amount from the material's amount
    //             $material->save();

    //             // Create a new Disbursement_detail record
    //             $disbursementDetail = new Disbursement_detail();
    //             $disbursementDetail->disbursement_id = $disbursement->id;
    //             $disbursementDetail->material_id = $material_id;
    //             $disbursementDetail->amount = $amount_selected;
    //             $disbursementDetail->save();
    //         } else {
    //             // Handle the case where the material is not found
    //             // You may want to log this or handle it differently based on your application logic
    //         }
    //     }

    //     return redirect()->route('withdraw.index_user')->with('success', 'withdraw successful!');
    // }
    public function store(Request $request)
    {
        // Validate the request
        // dd($request->all());
        $request->validate([
            'material_id' => 'required|array|min:1',
            'amount_selected' => 'required|array|min:1',
        ]);

        $user = Auth::user();

        // Create a new Disbursement record
        $disbursement = new Disbursement();
        $disbursement->date_disbursement = now();
        $disbursement->note_disbursement = $request->input('note_disbursement');
        $disbursement->user_id = $user->id;
        $disbursement->status = 'รอการอนุมัติ';
        $disbursement->save();

        // Process each selected material
        $selectedMaterialIds = $request->input('material_id');
        $amountsSelected = $request->input('amount_selected');
        // foreach ($selectedMaterialIds as $key => $material_id) {
        //     $material = Material::where('material_id', $material_id)->first(); // Find material by material_id
        //     if ($material) {
        //         $amount_selected = $amountsSelected[$key]; // Get the corresponding selected amount
        //         $material->amount -= $amount_selected; // Subtract the selected amount from the material's amount
        //         $material->save();

        //         // Create a new Disbursement_detail record
        //         $disbursementDetail = new Disbursement_detail();
        //         $disbursementDetail->disbursement_id = $disbursement->disbursement_id; // Assign the foreign key value
        //         $disbursementDetail->material_id = $material_id; // Assign the foreign key value
        //         $disbursementDetail->amount = $amount_selected;
        //         $disbursementDetail->save();
        //     } else {
        //         // Handle the case where the material is not found
        //         // You may want to log this or handle it differently based on your application logic
        //     }
        // }
        foreach ($selectedMaterialIds as $key => $material_id) {
            // $material  = $request->input('material_id');
            // $material = Material::findOrFail($material_id);
            $material = Material::where('material_id', $material_id)->first();
            // $material = Material::where('material_id', $material_id)->first(); // Find material by material_id
            if ($material) {
                $amount_selected = $amountsSelected[$key]; // Get the corresponding selected amount
                $material->amount -= $amount_selected; // Subtract the selected amount from the material's amount
                $material->save();

                // Create a new Disbursement_detail record
                $disbursementDetail = new Disbursement_detail();
                $disbursementDetail->disbursement_id = $disbursement->id; // Assign the foreign key value
                $disbursementDetail->material_id = $material_id; // Assign the foreign key value
                $disbursementDetail->amount = $amount_selected;
                $disbursementDetail->save();
            } else {
                // Handle the case where the material is not found
                // You may want to log this or handle it differently based on your application logic
            }
        }


        return redirect()->route('withdraw.index_user')->with('success', 'withdraw successful!');
    }




    public function index_history()
    {
        return view('withdraw.history');
    }

    public function considering()
    {
        $user = Auth::user();
        // $disbursement = Disbursement::where('user_id', $user->id)->where('status', 'รอการอนุมัติ')->get();
        $disbursement = Disbursement::withCount('disbursementLists')
        ->where('user_id', $user->id)
        ->where('status', 'รอการอนุมัติ')
        ->get();
        return view('withdraw.history_considering', compact('user', 'disbursement'));
    }

    public function considered()
    {
        $user = Auth::user();
        $disbursement = Disbursement::where('user_id', $user->id)->whereIn('status', ['อนุมัติแล้ว', 'ไม่อนุมัติ'])->get();
        return view('withdraw.history_considered', compact('user', 'disbursement'));
    }

    public function detail_considering(Request $request)
    {
        $disbursementId = $request->id;
        $disbursement = DB::table('disbursement')
                        ->join('users as sender', 'disbursement.user_id', '=', 'sender.id')
                        ->join('disbursement_detail', 'disbursement.disbursement_id', '=', 'disbursement_detail.disbursement_id')
                        ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
                        ->select(
                            'disbursement.*', 
                            'sender.name as sender_name'
                        )
                        ->where('disbursement.disbursement_id', $disbursementId)
                        ->first();
        $disbursement_detail = DB::table('disbursement_detail')
                            ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
                            ->select(
                                'disbursement_detail.*', 
                                'material.material_id as material_id',
                                'material.name as material_name'
                            )
                            ->where('disbursement_detail.disbursement_id', $disbursementId)
                            ->get();

        return view('withdraw.considering_detail', compact('disbursement','disbursement_detail'));
    }

    public function detail_considered(Request $request)
    {
        $disbursementId = $request->id;
        $disbursement = DB::table('disbursement')
                        ->join('users as sender', 'disbursement.user_id', '=', 'sender.id')
                        ->join('disbursement_detail', 'disbursement.disbursement_id', '=', 'disbursement_detail.disbursement_id')
                        ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
                        ->select(
                            'disbursement.*', 
                            'sender.name as sender_name'
                        )
                        ->where('disbursement.disbursement_id', $disbursementId)
                        ->first();

        $disbursement_detail = DB::table('disbursement_detail')
                            ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
                            ->select(
                                'disbursement_detail.*', 
                                'material.material_id as material_id',
                                'material.name as material_name'
                            )
                            ->where('disbursement_detail.disbursement_id', $disbursementId)
                            ->get();
             

        return view('withdraw.considered_detail', compact('disbursement','disbursement_detail'));
    }
}
