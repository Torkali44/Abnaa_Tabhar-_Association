<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterOrg extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'support_type',
        'donation_amount',
        'assistance_time',
        'attachments',
    ];

    protected $casts = [
        'support_type' => 'array',
        'attachments' => 'array',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }
}

