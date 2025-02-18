<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;
    protected $table = "contracts";

    protected $fillable = [
        'date_start',
        'date_end',
        'monthly_price',
        'box_id',
        'tenant_id',
        'user_id',
    ];
}
