<?php

namespace App\Eloquent;

use App\Eloquent\Relations\PrescriptionRelation;

class Prescription extends AbstractEloquent
{
    
    use PrescriptionRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name_prescription',
        'frequency',
        'guide',
        'status',
        'name_doctor',
        'doctor_id',
        'diagnose',
        'request_prescription_id',
    ];

    public function scopeGetPrescriptionsByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
