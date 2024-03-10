<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing_list extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = 
    [
        'borrowing_list_id', 
        'borrowing_id', 
        'durable_articles_id'
    ];
}
