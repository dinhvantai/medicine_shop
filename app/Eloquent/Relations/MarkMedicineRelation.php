<?php

namespace App\Eloquent\Relations;

use App\Eloquent\User;
use App\Eloquent\Medicine;

trait MarkMedicineRelation
{
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function getMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
