<?php

namespace App\Observers;

use App\Models\OrderProduct;
use App\Models\Product;

class OrderProductObserver
{
    /**
     * Handle the OrderProduct "created" event.
     */
    public function created(OrderProduct $orderProduct): void
    {
        $product = Product::find($orderProduct->product_id);
        $product->decrement('stok', $orderProduct->quantity);
    }

    /**
     * Handle the OrderProduct "updated" event.
     */
    public function updated(OrderProduct $orderProduct): void
    {
        $product = Product::find($orderProduct->product_id);
        $originalQuantity = $orderProduct->getOriginal('quantity');
        $newQuantity =  $orderProduct->quantity;
        if ($originalQuantity != $newQuantity) {
            $product->increment('stok', $originalQuantity);
            $product->increment('stok', $newQuantity);
        }
    }

    /**
     * Handle the OrderProduct "deleted" event.
     */
    public function deleted(OrderProduct $orderProduct): void
    {
        $product = Product::find($orderProduct->product_id);
        $product->increment('stok', $orderProduct->quantity);
    }

    /**
     * Handle the OrderProduct "restored" event.
     */
}
