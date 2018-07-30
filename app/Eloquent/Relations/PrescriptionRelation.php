<?php

namespace App\Eloquent\Relations;

use App\Eloquent\User;
use App\Eloquent\ItemPrescription;

trait PrescriptionRelation
{
    public function getAllItemPrescriptions()
    {
        return $this->hasMany(ItemPrescription::class, 'prescription_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDoctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
