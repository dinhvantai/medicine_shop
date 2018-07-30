<?php

namespace App\Eloquent\Relations;

use App\Eloquent\Comment;
use App\Eloquent\MarkMedicine;
use App\Eloquent\Prescription;

trait UserRelation
{
    public function getAllComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getAllMarkMedicines()
    {
        return $this->hasMany(MarkMedicine::class);
    }
    
    public function getAllPrescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
