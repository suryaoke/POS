<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'stok',
        'price',
        'image',
        'barcode',
        'description'

    ];
    protected $appends = ['image_url'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public static function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
    public function getImageUrlAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : null;
    }
    public function scopeSearch($query, $value)
    {
        $query->where("name", "like", "%{$value}%");
    }

    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
