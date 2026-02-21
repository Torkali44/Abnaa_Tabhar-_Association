<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'serial_code',
        'name',
        'gender',
        'birth_date',
        'spouse_name',
        'social_status',
        'address',
        'national_id',
        'phone',
        'monthly_income',
        'need_level',
        'has_children',
        'children',
        'family_status',
        'needs',
        'supporting_entity',
    ];

    protected $casts = [
        'monthly_income' => 'decimal:2',
        'birth_date' => 'date',
        'has_children' => 'boolean',
        'children' => 'array',
        'family_status' => 'array',
        'needs' => 'array',
        'supporting_entity' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->serial_code)) {
                $count = static::count() + 1;
                $model->serial_code = 'TAB-' . date('Y') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function getNeedLevelAttribute($value)
    {
        if ($value) {
            return $value;
        }

        $income = $this->monthly_income ?? 0;
        if ($income < 1000) {
            return 'عالي';
        }
        if ($income < 2500) {
            return 'متوسط';
        }
        return 'منخفض';
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('national_id', 'like', "%{$search}%")
              ->orWhere('serial_code', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }
}

