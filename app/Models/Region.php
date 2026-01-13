<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'currency',
        'timezone',
    ];

    // Relationships
    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereHas('vehicles', function ($q) {
            $q->where('status', 'available');
        });
    }

    public function scopeByCode($query, string $code)
    {
        return $query->where('code', strtolower($code));
    }

    // Helper methods
    public function getCurrencySymbol(): string
    {
        return match ($this->currency) {
            'EUR' => '€',
            'AED' => 'د.إ',
            'GBP' => '£',
            'USD' => '$',
            default => $this->currency
        };
    }

    public function getDefaultLanguage(): string
    {
        return match ($this->code) {
            'eu' => 'en',
            'uae' => 'ar',
            'us' => 'en',
            default => 'en'
        };
    }
}
