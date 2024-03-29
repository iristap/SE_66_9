<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $disbursement =  Disbursement::getAll();

        return view('disbursement.index',compact('disbursement'));
    }

    public function considering(Request $request): View
    {
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $dbm =  Disbursement::getAll();
        $dbm_ring = Disbursement::getConsidering();

        return view('disbursement.considering', compact('dbm','dbm_ring'));
    }

    public function considered(Request $request): View
    {
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $disbursement =  Disbursement::getAll();
        $dbm_red = Disbursement::getConsidered();

        return view('disbursement.considered', compact('disbursement', 'dbm_red'));
    }

    public function considering_details(Request $request): View
    {
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $dbmId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbmUser = Disbursement::getUserName($dbmId);
        $dbmMat = Disbursement::getMat($dbmId);
        $mat = Disbursement::getMatID($dbmId);


        return view('disbursement.considering_details', compact('dbmUser','dbmMat','mat'));
    }

    public function approved(Request $request): View
    {
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $disbursement_id = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbm = Disbursement::where('disbursement_id', $disbursement_id)->first();

        return view('disbursement.approved', compact('dbm','disbursement_id'));
    }

    public function a_update($id){
        // $request->validate(
        //     [
        //         'date_approved'=>'required'
        //     ],
        //     [
        //         'date_approved.required'=>'กรุณาใส่วันที่อนุมัติ'
        //     ]
        // );
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $data=[
            'date_approved'=>now(),
            'status'=>'อนุมัติแล้ว',
            'approver_id'=>auth()->id()
        ];
        DB::table('disbursement')
        ->where('disbursement_id', $id)
        ->update($data);

        return redirect('/disbursement/considering');
    }

    public function not_approved(Request $request): View
    {
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $disbursement_id = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbm = Disbursement::where('disbursement_id', $disbursement_id)->first();

        return view('disbursement.not_approved', compact('dbm','disbursement_id'));
    }

    public function na_update(Request $request, $id){
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $request->validate(
            [
                'note_approved'=>'required',
            ],
            [
                'note_approved.required'=>'โปรดป้อนหมายเหตุการไม่อนุมัติ',
            ]
            );
        $data=[
            'date_approved'=>now(),
            'status'=>'ไม่อนุมัติ',
            'approver_id'=>auth()->id(),
            'note_approved'=>$request->note_approved
        ];
        DB::table('disbursement')->where('disbursement_id', $id)->update($data);
        return redirect('/disbursement/considered');
    }

    public function considered_details(Request $request): View
    {
        if (!auth()->user()->roles()->where('role_id', 3)->exists()) {
            return view('home');
        }
        $dbmId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbmMat = Disbursement::getMat($dbmId);
        $dbmUser = Disbursement::getUserName($dbmId);
        $mat = Disbursement::getMatID($dbmId);
        $app = Disbursement::getApprover($dbmId);

        return view('disbursement.considered_details', compact('dbmMat', 'dbmUser', 'mat', 'app'));

    }

}
