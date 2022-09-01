<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'reference',
        'description',
        'price'
    ];

    protected function reference(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value),
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
