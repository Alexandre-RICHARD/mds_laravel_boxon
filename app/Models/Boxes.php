<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    use HasFactory;
    protected $table = "boxes";

    protected $fillable = [
        'adress',
        'number',
        'size',
        'user_id',
    ];
}
