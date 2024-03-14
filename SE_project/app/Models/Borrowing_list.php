<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getAll(){

        return $br_list=DB::table('borrowing_list')
        ->join('borrowing','borrowing_list.borrowing_id','=','borrowing.borrowing_id')
        ->join('users','borrowing.id_sender','=','users.id')
        ->join('durable_articles','borrowing_list.durable_articles_id','=','durable_articles.durable_articles_id')
        ->select('borrowing.*'
        , 'borrowing_list.*'
        , 'durable_articles.durable_articles_id as da_id'
        , 'durable_articles.name as da_name'
        , 'users.name as users_name'
        , 'users.id as users_id')
        ->get();
    }

    public static function getUserName($borrowing_id){

        return $br_list=DB::table('borrowing')
        ->join('users','borrowing.id_sender','=','users.id')
        ->join('borrowing_list','borrowing.borrowing_id','=','borrowing_list.borrowing_id')
        ->select('borrowing.*'
        , 'users.name as users_name'
        , 'users.id as users_id')
        ->where('borrowing.borrowing_id', $borrowing_id)
        ->first();
    }

    public static function getDurable($borrowing_id){

        return $br_list=DB::table('borrowing_list')
        ->join('borrowing','borrowing_list.borrowing_id','=','borrowing.borrowing_id')
        ->join('durable_articles','borrowing_list.durable_articles_id','=','durable_articles.durable_articles_id')
        ->select('borrowing.borrowing_id'
        , 'durable_articles.durable_articles_id as da_id'
        , 'durable_articles.name as da_name')
        ->where('borrowing.borrowing_id', $borrowing_id)
        ->get();
    }
}
