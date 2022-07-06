<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitiesModel extends Model
{
    use HasFactory;
    protected $table = "cities";
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at'
    ];
}
