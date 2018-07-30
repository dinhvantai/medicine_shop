<?php

namespace App\Eloquent\Relations;

use App\Eloquent\User;
use App\Eloquent\Image;
use App\Eloquent\Comment;
use App\Eloquent\Medicine;
use App\Eloquent\RateMedicine;

trait MedicineRelation
{
    public function getAllCategories()
    {
        return $this->belongsToMany(Medicine::class, 'category_medicine_related', 'medicine_id', 'category_id');
    }

    public function getAllImages()
    {
        return $this->hasMany(Image::class, 'medicine_id');
    }

    public function getAllRateMedicines()
    {
        return $this->hasMany(RateMedicine::class);
    }

    public function getAllComments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function getCreatedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
