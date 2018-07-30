<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Relations\MarkMedicineRelation;

class MarkMedicine extends Model
{
    
    use MarkMedicineRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'mark_medicine';

    protected $fillable = [
        'medicine_id',
        'user_id',
    ];

    public function scopeCheckMarkMedicine($query, $userId, $medicineId) {

        return $query->where('user_id', $userId)->where('medicine_id', $medicineId);
    }

    public function scopeGetMarkByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
