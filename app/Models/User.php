<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Team;
use App\Models\BrowsingHistory;
use App\Models\Rating;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasDefaultTenant, HasTenants, FilamentUser
{
    use HasApiTokens;
    use HasConnectedAccounts;
    use HasRoles;
    use HasFactory;
    use HasProfilePhoto {
        HasProfilePhoto::profilePhotoUrl as getPhotoUrl;
    }
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use TwoFactorAuthenticatable;
    use HasTeams;
    use HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    /**
     * Relación muchos-a-muchos con los productos en la lista de deseos
     */
    public function wishlist(): BelongsToMany
{
    return $this->belongsToMany(Product::class, 'wishlists')
               ->withTimestamps()
               ->withPivot(['share_token']);
}

    /**
     * Verifica si un producto está en la lista de deseos del usuario
     */
    public function hasInWishlist(Product $product): bool
    {
        return $this->wishlist()->where('product_id', $product->id)->exists();
    }

    /**
     * Cuenta los productos en la lista de deseos
     */
    public function wishlistCount(): int
    {
        return $this->wishlist()->count();
    }

    /**
     * Agrega un producto a la lista de deseos
     */
    public function addToWishlist(Product $product, ?string $shareToken = null): void
    {
        $this->wishlist()->attach($product->id, [
            'share_token' => $shareToken ?? bin2hex(random_bytes(16))
        ]);
    }

    /**
     * Elimina un producto de la lista de deseos
     */
    public function removeFromWishlist(Product $product): void
    {
        $this->wishlist()->detach($product->id);
    }

    /**
     * Obtiene el token de compartir para un producto específico
     */
    public function getShareTokenFor(Product $product): ?string
    {
        return $this->wishlist()
            ->where('product_id', $product->id)
            ->first()
            ?->pivot
            ->share_token;
    }

    /**
     * Panel de administración
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === "admin") {
            return $this->hasRole('admin');
        }
        return true;
    }

    /**
     * URL de la foto de perfil
     */
    public function profilePhotoUrl(): Attribute
    {
        return filter_var($this->profile_photo_path, FILTER_VALIDATE_URL)
            ? Attribute::get(fn () => $this->profile_photo_path)
            : $this->getPhotoUrl();
    }

    /**
     * Obtiene los tenants (equipos) del usuario
     */
    public function getTenants(Panel $panel): array|Collection
    {
        return $this->ownedTeams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->latestTeam;
    }

    /**
     * Relación con el equipo actual
     */
    public function latestTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    /**
     * Historial de navegación
     */
    public function browsingHistory(): HasMany
    {
        return $this->hasMany(BrowsingHistory::class);
    }

    /**
     * Valoraciones del usuario
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Membresías en equipos
     */
    public function membership(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withPivot(['role']);
    }
}