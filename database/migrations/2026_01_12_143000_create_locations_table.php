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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // {'en': 'Dubai Airport', 'ar': 'مطار دبي', 'fr': 'Aéroport de Dubai'}
            $table->string('code')->unique(); // DXB
            $table->enum('type', ['airport', 'city_center', 'hotel'])->default('city_center');
            $table->text('address');
            $table->string('city');
            $table->string('country');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('phone')->nullable();
            $table->json('opening_hours')->nullable(); // {'monday': '08:00-20:00', ...}
            $table->foreignId('region_id')->constrained('regions')->onDelete('restrict');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['region_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
