<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class disbursement_detail extends Model
{
    protected $table = 'disbursement_detail';
    protected $primaryKey = 'disbursement_id ';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable =
    [
        'disbursement_id ',
        'material_id ',
        'amount'
    ];

    public function disbursement()
    {
        return $this->belongsTo(disbursement::class, 'disbursement_id', 'disbursement_id');
    }
    
    public static function getApper($disbursement_id){

        return $br = DB::table('borrowing')
    ->select('disbursement.disbursement_id as bid','disbursement.id_approver as apper')
    ->where('disbursement.disbursement_id', $disbursement_id)
    ->get();
    }


}
