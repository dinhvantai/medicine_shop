<?php

namespace App\Eloquent;

use App\Eloquent\Relations\DoctorRequestRelation;

class RelatedDoctorRequest extends AbstractEloquent
{

    use DoctorRequestRelation;

    const STATUS_NEW = 0;
    const STATUS_WATCHECD = 1;
    const STATUS_RESPONSE = 2;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'request_prescription_id',
    ];

    public static function getOptionStatus()
    {
        return [
            self::STATUS_NEW => __('Not seen'),
            self::STATUS_WATCHECD => __('Watched'),
            self::STATUS_RESPONSE => __('Has responded'),
        ];
    }

    public function getRequestPrescription()
    {
        return $this->belongsTo(RequestPrescription::class, 'request_prescription_id');
    }
}
