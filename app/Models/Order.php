<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'name',
        'email',
        'gender',
        'phone',
        'birthday',
        'total_price',
        'note',
        'payment_method_id',
        'paid_amount',
        'change_amount'

    ];
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
