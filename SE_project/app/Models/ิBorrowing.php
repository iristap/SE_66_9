<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Borrowing extends Model {
    use HasFactory;
    public $timestamps = false;

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

}
