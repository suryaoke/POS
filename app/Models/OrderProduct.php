<?php

namespace App\Models;

use App\Observers\OrderProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(OrderProductObserver::class)]
class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'unit_price',
        'product_id',
        'quantity',
    ];
    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
