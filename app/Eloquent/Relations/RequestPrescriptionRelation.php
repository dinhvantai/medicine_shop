<?php

namespace App\Eloquent\Relations;

use App\Eloquent\User;
use App\Eloquent\Image;
use App\Eloquent\Prescription;
use App\Eloquent\RelatedDoctorRequest;

trait RequestPrescriptionRelation
{
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAllImages()
    {
        return $this->hasMany(Image::class, 'request_prescription_id');
    }

    public function getRelatedRequetDoctor()
    {
        return $this->hasOne(RelatedDoctorRequest::class, 'request_prescription_id');
    }

    public function getAllPrescription()
    {
        return $this->hasMany(Prescription::class, 'request_prescription_id');
    }
}
