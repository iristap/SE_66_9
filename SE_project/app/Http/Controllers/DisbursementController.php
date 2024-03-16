<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\Disbursement;



class DisbursementController extends Controller
{
    public function index(Request $request): View
    {
        $disbursement =  Disbursement::getAll();

        return view('disbursement.index',compact('disbursement'));
    }

    public function considering(Request $request): View
    {
        $dbm =  Disbursement::getAll();
        $dbm_ring = Disbursement::getConsidering();

        return view('disbursement.considering', compact('dbm','dbm_ring'));
    }

    public function considered(Request $request): View
    {
        $disbursement =  Disbursement::getAll();
        $dbm_red = Disbursement::getConsidered();

        return view('disbursement.considered', compact('disbursement', 'dbm_red'));
    }

    public function considering_details(Request $request): View
    {
        $dbmId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbmUser = Disbursement::getUserName($dbmId);
        $dbmMat = Disbursement::getMat($dbmId);
        $mat = Disbursement::getMatID($dbmId);


        return view('disbursement.considering_details', compact('dbmUser','dbmMat','mat'));
    }

    public function approved(Request $request): View
    {
        $disbursement_id = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbm = Disbursement::where('disbursement_id', $disbursement_id)->first();

        return view('disbursement.approved', compact('dbm','disbursement_id'));
    }

    public function a_update(Request $request, $id){
        $request->validate(
            [
                'date_approved'=>'required'
            ],
            [
                'date_approved.required'=>'กรุณาใส่วันที่อนุมัติ'
            ]
        );
        $data=[
            'date_approved'=>$request->date_approved,
            'status'=>$request->status
        ];
        DB::table('disbursement')->where('disbursement_id', $id)->update($data);
        return redirect('/disbursement/considering');
    }

    public function not_approved(Request $request): View
    {
        $disbursement_id = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbm = Disbursement::where('disbursement_id', $disbursement_id)->first();

        return view('disbursement.not_approved', compact('dbm','disbursement_id'));
    }

    public function na_update(Request $request, $id){
        $request->validate(
            [
                'date_approved'=>'required',
                'status'=>'required'
            ],
            [
                'date_approved.required'=>'กรุณาใส่วันที่ไพิจารณาม่อนุมัติ',
                'status.required'=>'กรุณาใส่หมายเหตุการไม่อนุมัติ'
            ]
        );
        $data=[
            'date_approved'=>$request->date_approved,
            'status'=>$request->status,
            'note_approved'=>$request->note_approved
        ];
        DB::table('disbursement')->where('disbursement_id', $id)->update($data);
        return redirect('/disbursement/considering');
    }

    public function considered_details(Request $request): View
    {
        $dbmId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbmMat = Disbursement::getMat($dbmId);
        $dbmUser = Disbursement::getUserName($dbmId);
        $mat = Disbursement::getMatID($dbmId);

        return view('disbursement.considered_details', compact('dbmMat', 'dbmUser', 'mat'));

    }

}
