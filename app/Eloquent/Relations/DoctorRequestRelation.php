<?php

namespace App\Eloquent\Relations;

use App\Eloquent\User;

trait DoctorRequestRelation
{
    public function getDoctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
