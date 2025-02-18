<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table = "bills";

    protected $fillable = [
        'amount',
        'paiement_date',
        'bills_period',
        'period_number',
        'contract_id',
    ];
}
