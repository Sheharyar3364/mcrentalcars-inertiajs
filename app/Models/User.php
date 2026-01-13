<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'driver_license_number',
        'driver_license_country',
        'driver_license_expiry',
        'preferred_language',
        'preferred_currency',
        'region_id',
        'workos_id',
        'organization_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'workos_id',
        'remember_token',
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
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'driver_license_expiry' => 'date',
        ];
    }


    // Relationships
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function isCorporate(): bool
    {
        return $this->organization && $this->organization->type === 'corporate';
    }

    public function hasDriverLicense(): bool
    {
        return !empty($this->driver_license_number)
            && !empty($this->driver_license_country)
            && $this->driver_license_expiry?->isFuture();
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getRegionCodeAttribute(): ?string
    {
        return $this->region?->code;
    }

    public function getRegionNameAttribute(): ?string
    {
        return $this->region?->name;
    }

    public function getRegionCurrencyAttribute(): ?string
    {
        return $this->region?->currency;
    }

    public function getRegionLanguageAttribute(): ?string
    {
        return $this->region?->language;
    }

    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }

    public function isInRegion(string $code): bool
    {
        return $this->region?->code === $code;
    }


    public function scopeInOrganization($query, $organizationId)
    {
        return $query->where('organization_id', $organizationId);
    }

    public function scopeWithWorkosId($query, $workosId)
    {
        return $query->where('workos_id', $workosId);
    }


    public function isActive(): bool
    {
        return $this->deleted_at === null;
    }
}
