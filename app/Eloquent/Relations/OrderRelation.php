<?php

namespace App\Eloquent\Relations;

use App\Eloquent\OrderItem;
use App\Eloquent\OrderAddress;

trait OrderRelation
{
    public function getOrderAddress()
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
