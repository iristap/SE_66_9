<?php

namespace App\Http\Controllers;
use App\Models\Durable;
use App\Models\disbursement;
use App\Models\disbursement_detail;
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
        $request->validate([
            'material_id' => 'required|array|min:1',
        ],);
        $user = Auth::user();
        $selectedMaterialIds = $request->input('material_id');
        $selectedMaterials = Material::whereIn('material_id', $selectedMaterialIds)->get();
        return view('withdraw.confirm_user', compact('selectedMaterials','user'));
    }


    public function store(Request $request)
    {
        $request->validate([
   //         'note_disbursement' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $disbursement = new Disbursement();
        $disbursement->date_disbursement = now();
        $disbursement->note_disbursement = $request->input('note_disbursement');
        $disbursement->status = 'ปกติ';
        $disbursement->id_sender = $user->id;
        $disbursement->save();
        $selectedMaterialIds = $request->input('material_id');
        foreach ($selectedMaterialIds as $material_id) {
            $material = Material::findOrFail($material_id);
            $material->availability_status = 'ไม่ว่าง';
            $material->save();
            $disbursementlist = new Disbursement_detail();
            $disbursementlist->disbursement_id = $disbursement->id;
            $disbursementlist->material_id = $material_id;
            $disbursementlist->save();
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
        $disbursements = Disbursement::where('id_sender', $user->id)->where('status','รอการอนุมัติ')->get();
        return view('withdraw.history_considering',compact('user','disbursements'));
    }

    public function considered()
    {
        $user = Auth::user();
        $disbursements = DB::table('disbursements')
                        ->join('users as sender', 'disbursements.id_sender', '=', 'sender.id')
                        ->join('users as approver', 'disbursements.id_approver', '=', 'approver.id')
                        ->join('users as checker', 'disbursements.id_checker', '=', 'checker.id')
                        ->select(
                            'disbursements.*', 
                            'sender.name as sender_name',
                            'approver.name as approver_name',
                            'checker.name as checker_name'
                        )
                        ->where('disbursements.id_sender', $user->id)
                        ->where('disbursements.status', 'พิจารณาแล้ว')
                        ->get();

        return view('withdraw.history_considered',compact('user','disbursements'));
    }

    public function detail(Request $request)
    {
        return view('withdraw.history_detail');
    }
}
