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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('driver_license_number')->nullable();
            $table->string('driver_license_country')->nullable();
            $table->date('driver_license_expiry')->nullable();
            $table->string('preferred_language', 5)->default('en');
            $table->string('preferred_currency', 3)->default('EUR');
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('restrict');
            $table->string('workos_id')->unique();
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('set null');
            $table->rememberToken();
            $table->text('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('password')->nullable();
            $table->index(['workos_id', 'organization_id', 'region_id']);
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
