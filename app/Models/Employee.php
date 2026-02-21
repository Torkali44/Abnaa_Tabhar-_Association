<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'name',
        'job_type',
        'phone',
        'monthly_salary',
        'vacations',
        'absences',
        'late_records',
        'attachments',
        'cases_handled_count',
        'assistance_disbursed_count',
    ];

    protected $casts = [
        'monthly_salary' => 'decimal:2',
        'vacations' => 'array',
        'absences' => 'array',
        'late_records' => 'array',
        'attachments' => 'array',
        'cases_handled_count' => 'integer',
        'assistance_disbursed_count' => 'integer',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('job_type', 'like', "%{$search}%");
        });
    }
}

