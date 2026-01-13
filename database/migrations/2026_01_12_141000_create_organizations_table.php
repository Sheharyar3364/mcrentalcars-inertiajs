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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('workos_id')->unique()->nullable();
            $table->string('name');
            $table->string('domain')->nullable();
            $table->enum('type', ['individual', 'corporate'])->default('individual');
            $table->string('contact_email')->nullable();
            $table->string('phone')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('tax_id')->nullable();
            $table->foreignId('region_id')->constrained('regions')->onDelete('restrict');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
