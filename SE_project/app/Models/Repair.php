<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Repair {
    use HasApiTokens,HasFactory, Notifiable;

    public function __construct(){

    }

    protected $fillable = [
           'no', 
           'durable_articles_id',
            'inspector_name',
            'status',
            'detail',
    ];
}