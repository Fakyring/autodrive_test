<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorsModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "colors";
    protected $fillable = [
        'id',
        'name'
    ];
}
