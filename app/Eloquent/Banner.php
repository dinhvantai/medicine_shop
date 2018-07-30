<?php

namespace App\Eloquent;

class Banner extends AbstractEloquent
{
    const POSITION_TOP = 'postion_top';
    const POSITION_BOTTOM = 'position_bottom';

    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path_main',
        'path_thumb',
        'position',
        'status',
        'options',
    ];

    public static function getPossitionOption()
    {
        return [
            self::POSITION_TOP => __('Position Top'),
            self::POSITION_BOTTOM => __('Position Bottom'),
        ];
    }
}
