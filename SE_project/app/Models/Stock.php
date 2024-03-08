<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'date_stock',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
        
    ];
    protected $dates = [
        'date_stock',
    ];


    public function stocker()
    {
        return $this->belongsTo(User::class, 'id_stocker');
    }
    public function stockLists()
    {
        return $this->hasMany(Stocks_list::class, 'id_stock');
    }


}
