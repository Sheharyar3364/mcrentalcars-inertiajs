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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');

            // Ratings (1-5)
            $table->unsignedTinyInteger('rating'); // Overall rating
            $table->unsignedTinyInteger('cleanliness_rating')->nullable();
            $table->unsignedTinyInteger('comfort_rating')->nullable();
            $table->unsignedTinyInteger('performance_rating')->nullable();
            $table->unsignedTinyInteger('value_rating')->nullable();

            // Review content
            $table->string('title')->nullable();
            $table->text('comment')->nullable();

            // Moderation
            $table->boolean('is_approved')->default(false);
            $table->text('admin_notes')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();

            // Indexes
            $table->index(['vehicle_id', 'is_approved', 'rating']);
            $table->index(['user_id']);
            $table->unique(['booking_id']); // One review per booking
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
