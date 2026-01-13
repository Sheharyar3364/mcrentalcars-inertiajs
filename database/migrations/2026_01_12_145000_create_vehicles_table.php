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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('location_id')->constrained()->onDelete('restrict'); // Default location
            // Region
            $table->foreignId('region_id')->constrained('regions')->onDelete('restrict');


            // Basic info
            $table->string('make'); // Toyota, BMW, etc.
            $table->string('model');
            $table->integer('year');
            $table->string('license_plate')->unique();
            $table->string('vin')->unique();
            $table->string('color')->nullable();

            // Specs
            $table->enum('transmission', ['automatic', 'manual', 'semi_automatic'])->default('automatic');
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid'])->default('petrol');
            $table->integer('seats')->default(5);
            $table->integer('doors')->default(4);
            $table->decimal('engine_size', 3, 1)->nullable(); // 2.0L
            $table->integer('mileage')->default(0); // Current kilometers

            // Features (stored as JSON)
            $table->json('features')->nullable(); // ['GPS', 'Bluetooth', 'Backup Camera']

            // Images
            $table->json('images')->nullable(); // Array of image URLs

            // Pricing
            $table->string('currency', 3)->default('EUR'); // ISO currency code
            $table->decimal('daily_rate', 10, 2); // base currency
            $table->decimal('weekly_discount_percent', 5, 2)->default(10.00); // 10% off for 7+ days
            $table->decimal('monthly_discount_percent', 5, 2)->default(20.00); // 20% off for 30+ days

            // Insurance & deposits
            $table->decimal('insurance_daily_premium', 8, 2)->default(0);
            $table->decimal('insurance_daily_comprehensive', 8, 2)->default(0);
            $table->decimal('security_deposit', 10, 2)->default(500.00);

            // Availability
            $table->enum('status', ['available', 'rented', 'maintenance', 'retired'])->default('available');
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();

            // Maintenance
            $table->date('last_service_date')->nullable();
            $table->date('next_service_date')->nullable();
            $table->integer('next_service_mileage')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['category_id', 'status', 'region_id']);
            $table->index(['location_id', 'region_id']);
            $table->index(['status', 'region_id', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
