<?php

namespace App\Eloquent\Relations;

use App\Eloquent\Category;
use App\Eloquent\Medicine;

trait CategoryRelation
{
    public function getAllMedicines()
    {
        return $this->belongsToMany(Medicine::class, 'category_medicine_related', 'category_id', 'medicine_id');
    }

    public function getSubCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getParentFromSubCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
