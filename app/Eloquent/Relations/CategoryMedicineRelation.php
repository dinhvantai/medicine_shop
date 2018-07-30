<?php

namespace App\Eloquent\Relations;

use App\Eloquent\Category;
use App\Eloquent\Medicine;

trait CategoryMedicineRelation
{

    public function getAllMedicines()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function getAllCategories()
    {
        return $this->belongsTo(Category::class);
    }
}
