<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Borrowing extends Model {
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'borrowing';
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
        return $this->belongsTo(User::class, 'id_sender', 'id');
    }

    public function borrowingLists()
    {
        return $this->hasMany(Borrowing_list::class, 'borrowing_id', 'borrowing_id');
    }
}
