<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing_list extends Model
{
    use HasFactory;
    protected $table = 'borrowing_list';
    protected $primaryKey = 'borrowing_list_id';
    public $timestamps = false;
    protected $fillable = 
    [
        'borrowing_list_id', 
        'borrowing_id', 
        'durable_articles_id'
    ];
    
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrowing_id', 'borrowing_id');
    }

    public function durable()
    {
        return $this->belongsTo(Durable::class, 'durable_articles_id', 'durable_articles_id');
    }
}
