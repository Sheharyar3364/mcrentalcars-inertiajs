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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Payment details
            $table->string('transaction_id')->unique();
            $table->string('payment_method'); // stripe, paypal, bank_transfer
            $table->string('payment_gateway_id')->nullable(); // Stripe payment intent ID

            // Amount
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3);

            // Status
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed',
                'refunded',
                'partial_refund'
            ])->default('pending');

            // Refund info
            $table->decimal('refund_amount', 10, 2)->nullable();
            $table->text('refund_reason')->nullable();
            $table->dateTime('refunded_at')->nullable();

            // Metadata
            $table->json('metadata')->nullable(); // Store gateway response
            $table->text('failure_reason')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['booking_id', 'status']);
            $table->index(['user_id']);
            $table->index(['transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
