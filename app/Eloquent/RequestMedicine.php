<?php

namespace App\Eloquent;

use App\Eloquent\Relations\RequestMedicineRelation;

class RequestMedicine extends AbstractEloquent
{
    
    use RequestMedicineRelation;

    const STATUS_NOT_SEEN = 1;
    const STATUS_WATCHED = 2;
    const STATUS_HAS_RESPONDED = 3;

    const PATH_REQUEST = 'uploads/request-medicine/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'medicine_name',
        'short_describer',
        'respone_admin',
        'status',
        'user_id',
    ];

    public static function getOptionStatus()
    {
        return [
            self::STATUS_NOT_SEEN => __('Not seen'),
            self::STATUS_WATCHED => __('Watched'),
            self::STATUS_HAS_RESPONDED => __('Has responded'),
        ];
    }
    
}
