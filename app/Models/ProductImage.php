<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];

public function getUrlAttribute()
{
    return asset('storage/products/' . $this->filename); // o lo que corresponda
}
}
