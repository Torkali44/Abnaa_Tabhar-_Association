<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'supporter_id',
        'supporter_type',
        'beneficiary_id',
        'amount',
        'category',
        'date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}

