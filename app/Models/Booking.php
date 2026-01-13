<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'user_id',
        'vehicle_id',
        'pickup_location_id',
        'return_location_id',
        'pickup_date',
        'return_date',
        'daily_rate',
        'base_price',
        'insurance_cost',
        'extras_cost',
        'delivery_fee',
        'discount_amount',
        'taxes',
        'total_price',
        'currency',
        'insurance_type',
        'extras',
        'driver_name',
        'driver_email',
        'driver_phone',
        'driver_license_number',
        'driver_license_country',
        'status',
        'payment_status',
        'special_requests',
        'cancellation_reason',
        'cancelled_at',
        'actual_pickup_at',
        'actual_return_at',
        'mileage_start',
        'mileage_end',
        'fuel_level_start',
        'fuel_level_end',
    ];

    protected function casts(): array
    {
        return [
            'pickup_date' => 'datetime',
            'return_date' => 'datetime',
            'cancelled_at' => 'datetime',
            'actual_pickup_at' => 'datetime',
            'actual_return_at' => 'datetime',
            'daily_rate' => 'decimal:2',
            'base_price' => 'decimal:2',
            'insurance_cost' => 'decimal:2',
            'extras_cost' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'taxes' => 'decimal:2',
            'total_price' => 'decimal:2',
            'extras' => 'array',
            'fuel_level_start' => 'decimal:1',
            'fuel_level_end' => 'decimal:1',
        ];
    }

    // Boot method to generate booking number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_number)) {
                $booking->booking_number = static::generateBookingNumber($booking->vehicle->region ?? 'eu');
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function pickupLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function returnLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'return_location_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['confirmed', 'active']);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Helper methods
    public static function generateBookingNumber(string $region = 'EU'): string
    {
        $prefix = 'MC-' . strtoupper($region);
        $date = now()->format('Ymd');
        $maxRetries = 5;
        $attempt = 0;

        do {
            $lastBooking = static::whereDate('created_at', today())
                ->where('booking_number', 'like', "{$prefix}-{$date}-%")
                ->latest('id')
                ->first();

            $lastSeq = 0;
            if ($lastBooking) {
                $parts = explode('-', $lastBooking->booking_number);
                $lastSeq = (int) end($parts);
            }

            $sequence = $lastSeq + 1;
            $bookingNumber = sprintf('%s-%s-%03d', $prefix, $date, $sequence);
            $attempt++;
        } while (static::where('booking_number', $bookingNumber)->exists() && $attempt < $maxRetries);

        return $bookingNumber;
    }


    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed'])
            && $this->pickup_date->isFuture()
            && $this->pickup_date->diffInHours(now()) > 24;
    }

    public function canBeReviewed(): bool
    {
        return $this->status === 'completed'
            && !$this->review()->exists();
    }
}
