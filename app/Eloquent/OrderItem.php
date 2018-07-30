<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\Relations\BelongsToOrder;

class OrderItem extends Model
{
    
    use BelongsToOrder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'medicine_id',
        'medicine_name',
        'price',
        'qty_ordered',
        'row_total',
    ];
}
