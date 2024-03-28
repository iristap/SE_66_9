<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Repair extends Model{

    use HasFactory;
    protected $table = 'repair_list';
    protected $primaryKey = 'no';
    public $timestamps = false;
    protected $fillable = [
           'no', 
           'durable_articles_id',
            'inspector_name',
            'status',
            'detail',
    ];

    public function durable()
    {
        return $this->belongsTo(Durable::class, 'durable_articles_id', 'durable_articles_id');
    }
    
    public function borrowingList()
    {
        return $this->belongsTo(Borrowing_list::class, 'borrowing_list_id', 'borrowing_list_id');
    }

}