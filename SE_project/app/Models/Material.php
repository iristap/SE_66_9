<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Material extends Model
{
    use HasFactory;
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'material';
    public static function getAll()
    {
        return $material=DB::table('material')->get();
    }
}