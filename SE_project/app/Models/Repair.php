<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Repair extends Model{

    use HasFactory;
    protected $table = 'repair_list';

    protected $fillable = [
           'no', 
           'durable_articles_id',
            'inspector_name',
            'status',
            'detail',
    ];

}