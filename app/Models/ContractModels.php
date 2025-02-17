<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractModels extends Model
{
    use HasFactory;
    protected $table = "contract_models";

    protected $fillable = [
        'name',
        'content',
        'user_id',
    ];
}
