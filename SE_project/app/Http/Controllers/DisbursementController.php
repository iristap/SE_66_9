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
        $dbmItem = Disbursement::getID($dbmId);
        $dbmUser = Disbursement::getUserName($dbmId);
        $dbmMat = Disbursement::getMat($dbmId);


        return view('disbursement.considering_details', compact('dbmItem','dbmId','dbmUser','dbmMat'));
    }

    public function considered_details(Request $request): View
    {
        $dbmId = $request->id; // รับ borrowing_id จาก request
        // ค้นหาการยืมที่มี borrowing_id ตรงกับที่ส่งมา
        $dbmItem = Disbursement::getID($dbmId);
        $dbmUser = Disbursement::getUserName($dbmId);
        $dbmMat = Disbursement::getMat($dbmId);
        $dbmNote = Disbursement::getNote($dbmId);
        $dbApp = Disbursement::getApprover($dbmId);


        return view('disbursement.considered_details', compact('dbmItem','dbmId','dbmUser','dbmMat','dbmNote','dbApp'));

    }

}
