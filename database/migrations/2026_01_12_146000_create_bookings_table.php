<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique(); // MC-EU-20250112-001
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('restrict');
            $table->foreignId('pickup_location_id')->constrained('locations')->onDelete('restrict');
            $table->foreignId('return_location_id')->constrained('locations')->onDelete('restrict');

            // Dates and times
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->integer('total_days')
                ->storedAs("EXTRACT(DAY FROM return_date - pickup_date)::integer");
            // Pricing breakdown
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('base_price', 10, 2); // daily_rate * total_days
            $table->decimal('insurance_cost', 10, 2)->default(0);
            $table->decimal('extras_cost', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('taxes', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);
            $table->string('currency', 3)->default('EUR');

            // Insurance & extras
            $table->enum('insurance_type', ['basic', 'premium', 'comprehensive'])->default('basic');
            $table->json('extras')->nullable(); // ['gps', 'child_seat', 'additional_driver']

            // Driver info
            $table->string('driver_name');
            $table->string('driver_email');
            $table->string('driver_phone');
            $table->string('driver_license_number');
            $table->string('driver_license_country');

            // Status tracking
            $table->enum('status', [
                'pending',      // Created, awaiting payment
                'confirmed',    // Payment confirmed
                'active',       // Vehicle picked up
                'completed',    // Vehicle returned
                'cancelled'     // Booking cancelled
            ])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid', 'refunded', 'partial_refund'])->default('unpaid');

            // Additional fields
            $table->text('special_requests')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->dateTime('cancelled_at')->nullable();

            // Actual pickup/return (filled when vehicle handed over)
            $table->dateTime('actual_pickup_at')->nullable();
            $table->dateTime('actual_return_at')->nullable();
            $table->integer('mileage_start')->nullable();
            $table->integer('mileage_end')->nullable();
            $table->decimal('fuel_level_start', 3, 1)->nullable(); // 0.0 to 1.0 (0% to 100%)
            $table->decimal('fuel_level_end', 3, 1)->nullable();

            $table->timestamps();
            $table->softDeletes();
            // Indexes
            $table->index(['user_id', 'status']);
            $table->index(['vehicle_id', 'status', 'pickup_date', 'return_date']); // For availability checks
            $table->index(['booking_number']);
            $table->index(['pickup_date', 'return_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
