<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'location_id',
        'region_id',
        'make',
        'model',
        'year',
        'license_plate',
        'vin',
        'color',
        'transmission',
        'fuel_type',
        'seats',
        'doors',
        'engine_size',
        'mileage',
        'features',
        'images',
        'currency',
        'daily_rate',
        'weekly_discount_percent',
        'monthly_discount_percent',
        'insurance_daily_premium',
        'insurance_daily_comprehensive',
        'security_deposit',
        'status',
        'available_from',
        'available_until',
        'last_service_date',
        'next_service_date',
        'next_service_mileage',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'images' => 'array',
            'daily_rate' => 'decimal:2', // ✅ CHANGED
            'engine_size' => 'decimal:1',
            'weekly_discount_percent' => 'decimal:2',
            'monthly_discount_percent' => 'decimal:2',
            'insurance_daily_premium' => 'decimal:2',
            'insurance_daily_comprehensive' => 'decimal:2',
            'security_deposit' => 'decimal:2',
            'available_from' => 'date',
            'available_until' => 'date',
            'last_service_date' => 'date',
            'next_service_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByLocation($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }

    // Helper methods
    public function getFullName(): string
    {
        return "{$this->make} {$this->model} ({$this->year})";
    }

    public function getPrimaryImage(): ?string
    {
        return $this->images[0] ?? null;
    }

    public function getAverageRating(): float
    {
        return $this->reviews()
            ->where('is_approved', true)
            ->avg('rating') ?? 0;
    }

    public function getTotalReviews(): int
    {
        return $this->reviews()
            ->where('is_approved', true)
            ->count();
    }

    public function isAvailableForDates(string $pickupDate, string $returnDate): bool
    {
        if ($this->status !== 'available') {
            return false;
        }

        // Check if there are any conflicting bookings
        return !$this->bookings()
            ->whereIn('status', ['confirmed', 'active'])
            ->where(function ($query) use ($pickupDate, $returnDate) {
                $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                    ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                    ->orWhere(function ($q) use ($pickupDate, $returnDate) {
                        $q->where('pickup_date', '<=', $pickupDate)
                            ->where('return_date', '>=', $returnDate);
                    });
            })
            ->exists();
    }

    public function needsService(): bool
    {
        return $this->next_service_date?->isPast()
            || ($this->next_service_mileage && $this->mileage >= $this->next_service_mileage);
    }

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
}
