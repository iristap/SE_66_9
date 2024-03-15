<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Borrowing extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'borrowing_id';
    protected $fillable = [
        'borrowing_id',
        'borrow_date',
        'due_date',
        'return_date',
        'borrowing_note',
        'not_approved',
        'approved_date',
        'id_sender',
        'id_approver',
        'id_checker',
        'status',
    ];

    protected $dates = [
        'borrow_date',
        'due_date',
        'return_date',
        'approved_date',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'id_sender','id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'id_approver', 'id');
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'id_checker', 'id');
    }

    public function borrowingLists()
    {
        return $this->hasMany(Borrowing_list::class, 'borrowing_id', 'borrowing_id');
    }
    /**
     * The table associates with the model.
     * @var string
     */
    protected $table = 'borrowing';
    public static function getAll(){

        return $br = DB::table('borrowing')
    ->join('users', 'id_sender', '=', 'users.id')
    ->select('borrowing.*', 'users.name as users_name')
    ->get();

    }


}
