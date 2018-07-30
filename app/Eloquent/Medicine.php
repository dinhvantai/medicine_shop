<?php

namespace App\Eloquent;

use Laravel\Scout\Searchable;
use App\Eloquent\Relations\MedicineRelation;

class Medicine extends AbstractEloquent
{
    // use Searchable;
    use MedicineRelation;

    const ALLOWED_BUY = 1;
    const NOT_ALLOWED_BUY = 0;
    
    const PATH_MEDICINE = 'uploads/medicines/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'symptom',
        'short_describer',
        'detail',
        'user_id',
        'avg_rate',
        'total_rate',
        'related_medicine',
        'price',
        'quantity',
        'allowed_buy',
        'unit',
        'guide',
        'ingredient',
        'made_in',
        'unintended_effect',
        'contraindications',
    ];

    public function searchableAs()
    {
        return 'name';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }

    public static function getOptionAllowedBuy()
    {
        return [
            self::NOT_ALLOWED_BUY => __('Not allowed to buy'),
            self::ALLOWED_BUY => __('Allowed to buy'),
        ];
    }
}
