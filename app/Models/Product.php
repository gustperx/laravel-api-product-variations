<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
}
