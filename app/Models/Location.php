<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'code',
        'type',
        'address',
        'city',
        'country',
        'latitude',
        'longitude',
        'phone',
        'opening_hours',
        'region_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'opening_hours' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_active' => 'boolean',
        ];
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function pickupBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'pickup_location_id');
    }

    public function returnBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'return_location_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRegion($query, string $region)
    {
        return $query->where('region', $region);
    }
}
