<?php

namespace App\Eloquent;

class Comment extends AbstractEloquent
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE  = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'medicine_id',
        'content',
        'status',
    ];

    public static function getOptionStatus()
    {
        return [
            self::STATUS_DISABLE => __('Disable'),
            self::STATUS_ENABLE => __('Enable'),
        ];
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMedicine()
    {
    	return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}