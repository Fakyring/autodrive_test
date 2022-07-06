<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonsModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "salons";
    protected $fillable = [
        'id',
        'name',
        'city_id',
        'status',
        'created_at',
        'updated_at'
    ];
}
