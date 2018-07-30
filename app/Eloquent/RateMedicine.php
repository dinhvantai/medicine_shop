<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Relations\RateMedicineRelation;

class RateMedicine extends Model
{

    use RateMedicineRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'medicine_id',
        'point_rate',
        'title',
        'content',
    ];
    
    public function scopeGetRateId($query, $medicine_id)
    {
        return $query->where('medicine_id', $medicine_id);
    }

    public function scopeStarNumber($query, $id, $point_rate) 
    {
        return $query->where('medicine_id', $id)->where('point_rate', $point_rate);    
    }

    public function scopeCheckRated($query, $user_id, $id) 
    {
        return $query->where('user_id', $user_id)->where('medicine_id', $id);
    }
}
