<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks_list extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_stock', 'material_id', 'quantity'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock', 'id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'material_id');
    }
}
