<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Disbursement extends Model
{
    use HasFactory;
    /**
     * The table associates with the model.
     * @var string
     */
    protected $table = 'disbursement';
    public $timestamps = false;
    public static function getAll(){

        return $dbm=DB::table('disbursement')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('disbursement.*', 'users.name as uname')
        ->get();
    }

    public static function getUserName($db_id){

        return $br_list=DB::table('disbursement')
        ->join('users', 'user_id', '=', 'users.id')
        ->join('disbursement_detail', 'disbursement.disbursement_id', '=', 'disbursement_detail.disbursement_id')
        ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
        ->select('disbursement.*'
        , 'users.name as users_name'
        , 'users.id as users_id'
        , 'material.name as mname'
        , 'material.material_id as mid'
        , 'disbursement_detail.amount as dbmamount')
        ->where('disbursement.disbursement_id', $db_id)
        ->first();
    }

    public static function getID($db_id){

        return $dbm=DB::table('disbursement')
        ->join('users', 'user_id', '=', 'users.id')
        ->join('disbursement_detail', 'disbursement.disbursement_id', '=', 'disbursement_detail.disbursement_id')
        ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
        ->select('disbursement.*', 'disbursement_detail.*', 'users.name as uname', 'material.name')
        ->where('disbursement.disbursement_id', $db_id)
        ->get();
    }

    public static function getMat($db_id){

        return $dbm=DB::table('disbursement')
        ->join('disbursement_detail', 'disbursement.disbursement_id', '=', 'disbursement_detail.disbursement_id')
        ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
        ->select('disbursement.disbursement_id', 'material.material_id', 'material.name', 'disbursement_detail.amount')
        ->where('disbursement.disbursement_id', $db_id)
        ->first();
    }

    public static function getMatID($db_id){

        return $dbm=DB::table('disbursement_detail')
        ->join('material', 'disbursement_detail.material_id', '=', 'material.material_id')
        ->select('disbursement_detail.disbursement_id as dbmid', 'disbursement_detail.material_id as mid', 'material.name as mname', 'disbursement_detail.amount as amount')
        ->where('disbursement_detail.disbursement_id', $db_id)
        ->get();
    }

    public static function getNote($db_id){

        return $dbm=DB::table('disbursement')
        ->join('disbursement_detail', 'disbursement.disbursement_id', '=', 'disbursement_detail.disbursement_id')
        ->select('disbursement.disbursement_id', 'disbursement.note_approved', 'disbursement.note_disbursement')
        ->where('disbursement.disbursement_id', $db_id)
        ->get();
    }

    public static function getConsidering(){

        return $dbm=DB::table('disbursement')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('disbursement.*','users.name as uname')
        ->where('disbursement.status', 'รอการอนุมัติ')
        ->get();
    }

    public static function getConsidered(){

        return $dbm=DB::table('disbursement')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('disbursement.*','users.name as uname')
        ->where('disbursement.status', 'อนุมัติแล้ว')
        ->orWhere('disbursement.status', 'ไม่อนุมัติ')
        ->get();
    }

    public static function getApprover($dbmId){

        return $dbm=DB::table('disbursement')
        ->join('users', 'disbursement.approver_id', '=', 'users.id')
        ->select('disbursement.approver_id', 'users.name')
        ->where(function ($query) {
            $query->where('disbursement.status', 'ไม่อนุมัติ')
                ->orWhere('disbursement.status', 'อนุมัติแล้ว');
        })
        ->where('disbursement.disbursement_id', $dbmId)
        ->first();
    }


    public function DisbursementLists()
    {
        return $this->hasMany(disbursement_detail::class, 'disbursement_id', 'disbursement_id');
    }

}
