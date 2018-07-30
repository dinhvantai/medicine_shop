<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Relations\RequestPrescriptionRelation;

class RequestPrescription extends Model
{

    use RequestPrescriptionRelation;

    const STATUS_NEW = 0;
    const STATUS_WATCHECD = 1;
    const STATUS_RESPONSE = 2;
    
    const PATH_REQUEST = 'uploads/request-prescription/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'describer',
    ];
    
    public function getOptionStatus()
    {
        return [
            self::STATUS_NEW => __('Not seen'),
            self::STATUS_WATCHECD => __('Watched'),
            self::STATUS_RESPONSE => __('Has responded'),
        ];
    }

    public function scopeGetRequestByUser($query ,$user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
