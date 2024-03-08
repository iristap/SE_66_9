<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Durable extends Model
{
    use HasFactory;


    protected $fillable = [
        'durable_articles_id',
        'durable_articles_code',
        'name',
        'status',
    ];
}
