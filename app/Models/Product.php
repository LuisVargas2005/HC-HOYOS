<?php

namespace App\Models;

use App\Interfaces\Orderable;
use Illuminate\Support\Str;
use App\Traits\IsTenantModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model implements Orderable
{
    use HasFactory, IsTenantModel;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug', // ✅ AÑADIDO
        'description',
        'short_description',
        'long_description',
        'price',
        'category_id',
        'featured_image',
        'inventory_count',
        'low_stock_threshold',
        //'meta_title',
        //'meta_description',
        //'meta_keywords',
        'expiration_time',
        'pricing_type',
        'suggested_price',
        'minimum_price',
        'is_featured',
        'is_active',
        'weight',
        'dimensions',
        'sku'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'suggested_price' => 'decimal:2',
        'minimum_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'weight' => 'decimal:2',
    ];

    protected $appends = [
        'image_url',
        'slug',
        'formatted_price'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(ProductCollection::class, 'collection_items')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function wishedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProductRating::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->featured_image && Storage::disk('public')->exists($this->featured_image)) {
            return asset('storage/' . $this->featured_image);
        }

        if ($image = $this->images()->first()) {
            if (Storage::disk('public')->exists($image->path)) {
                return asset('storage/' . $image->path);
            }
        }

        return asset('images/placeholder.png');
    }

    public function getSlugAttribute(): string
    {
        return $this->attributes['slug'] ?? Str::slug($this->name);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 3, '.', ',');
    }


    public function isLowStock(): bool
    {
        return $this->inventory_count <= $this->low_stock_threshold;
    }

    public function averageRating(): float
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function getPrice(): float
    {
        return $this->isFree() ? 0.00 : $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isFree(): bool
    {
        return $this->pricing_type === 'free';
    }

    public function isDonationBased(): bool
    {
        return $this->pricing_type === 'donation';
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('description', 'like', '%' . $keyword . '%')
              ->orWhere('sku', 'like', '%' . $keyword . '%');
        });
    }

    public function scopeWithCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePriceRange(Builder $query, ?float $min, ?float $max): Builder
    {
        return $query->when($min, fn($q) => $q->where('price', '>=', $min))
                     ->when($max, fn($q) => $q->where('price', '<=', $max));
    }

    public function scopeWithTag(Builder $query, Tag $tag): Builder
    {
        return $query->whereHas('tags', fn($q) => $q->where('tags.id', $tag->id));
    }

    public function scopeWithTagNames(Builder $query, array $tagNames): Builder
    {
        return $query->whereHas('tags', fn($q) => $q->whereIn('name', $tagNames));
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name); // ✅ AUTOGENERAR SLUG
            }

            if (empty($product->sku)) {
                $product->sku = Str::upper(Str::random(8));
            }
        });

        static::saving(function ($product) {
            $product->meta_title = $product->meta_title ?: Str::limit($product->name, 60);
            $product->meta_description = $product->meta_description ?: Str::limit($product->description, 160);
        });
    }
}