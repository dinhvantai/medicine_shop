<?php

namespace App\Eloquent\Relations;

use App\Eloquent\Medicine;
use App\Eloquent\Prescription;
use App\Eloquent\RequestMedicine;

trait ItemPrescriptionRelation
{
    public function getPrescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function getMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function getRequestMedicine()
    {
        return $this->hasOne(RequestMedicine::class, 'item_prescription_id');
    }
}
