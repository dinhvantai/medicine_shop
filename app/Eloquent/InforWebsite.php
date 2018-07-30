<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class InforWebsite extends Model
{
    const POSITION_MAIN = 'position_main';

    const ALLOW_ORDERED_OUT_STOCK = 1;
    const NOT_ORDERED_OUT_STOCK = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slogan',
        'logo',
        'link_communications',
        'footer',
        'options',
        'position',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function getOptionOrdered()
    {
        return [
            self::NOT_ORDERED_OUT_STOCK => __('Not allow ordered when out stock!'),
            self::ALLOW_ORDERED_OUT_STOCK => __('Allow ordered when out stock!'),
        ];
    }

    public function scopeGetInfoWebsite($query)
    {
        return $query->where('position', self::POSITION_MAIN);
    }

    public static function getPositionOption()
    {
        return [
            self::POSITION_MAIN => __('Position Main'),
        ];
    }
}
