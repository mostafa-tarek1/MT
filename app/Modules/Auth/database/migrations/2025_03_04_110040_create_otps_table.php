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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->string('identifier')->nullable(); // Email or Phone
            $table->string('email')->nullable();
            $table->string('code'); // OTP code
            $table->string('otp')->nullable(); // Keep for backward compatibility
            $table->string('type')->default('email'); // Type: email, phone, etc.
            $table->timestamp('expires_at')->nullable(); // When OTP expires
            $table->timestamp('expire_at')->nullable(); // Keep for backward compatibility
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
