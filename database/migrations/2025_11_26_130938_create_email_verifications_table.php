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
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // TAMBAHKAN
            $table->string('otp', 6);
            $table->timestamp('expires_at'); // TAMBAHKAN
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('type')->nullable();
            $table->string('send_via')->nullable();
            $table->integer('resend')->default(0);
            $table->string('status')->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_verifications');
    }
};
