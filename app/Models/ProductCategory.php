<?php

namespace App\Models;

use App\Traits\IsTenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;
    use IsTenantModel;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'slug', // ✅ importante agregar
        'description',
        'parent_category_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Genera automáticamente el slug al crear una categoría.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_category_id');
    }

    // Eliminamos getSlugAttribute porque ahora se guarda en DB directamente
}
