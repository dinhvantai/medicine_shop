<?php

namespace App\Eloquent\Relations;

use App\Eloquent\Order;

trait BelongsToOrder
{
    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
