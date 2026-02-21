<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterIndividual extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone',
        'national_id',
        'donation_type',
        'donation_amount',
        'donation_time',
        'donation_date',
        'contact_method',
        'payment_method',
        'donation_goal',
        'attachments',
    ];

    protected $casts = [
        'donation_goal' => 'array',
        'attachments' => 'array',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('national_id', 'like', "%{$search}%");
        });
    }
}

