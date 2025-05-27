<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Downloadable extends Model
{
    protected $fillable = [
        'product_id',
        'file_path',
        'download_limit',
        'expiration_days',
        'file_name',
        'file_size'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}