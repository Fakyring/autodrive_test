<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    use HasFactory;
    protected $table = "stock";
    protected $fillable = [
        'id',
        'model_id',
        'salon_id',
        'color_id',
        'year',
        'price',
        'power',
        'reserver',
        'desc',
        'created_at',
        'updated_at'
    ];
}
