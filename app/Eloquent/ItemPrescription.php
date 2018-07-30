<?php

namespace App\Eloquent;

use App\Eloquent\Relations\ItemPrescriptionRelation;

class ItemPrescription extends AbstractEloquent
{

    use ItemPrescriptionRelation;

    const STATUS_IN_STORE = 1;
    const STATUS_OUT_STORE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'medicine_id',
        'name_medicine',
        'prescription_id',
        'amount',
        'status',
        'guide',
        'qty_purchased',
    ];

    public static function getOptionStatus()
    {
        return [
            self::STATUS_OUT_STORE => __('Out Store'),
            self::STATUS_IN_STORE => __('In Store'),
        ];
    }
}
