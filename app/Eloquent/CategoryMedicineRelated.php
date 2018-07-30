<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Relations\CategoryMedicineRelation;

class CategoryMedicineRelated extends Model
{

    use CategoryMedicineRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'medicine_id',
    ];

    protected $table = 'category_medicine_related';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
