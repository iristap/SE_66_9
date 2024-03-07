<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Durable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string,>
     */
    public function __construct(){ 
    }
    protected $fillable = [
        'durable_articles_id',
        'durable_articles_code',
        'name',
        'status',
    ];
}
