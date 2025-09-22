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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('admin_id');
            $table->unsignedBigInteger('user_id');
            $table->string('employee_id', 20)->unique();
            $table->date('hire_date');
            $table->string('department', 50)->default('Library Management');
            $table->json('permissions')->nullable()->comment('Specific admin permissions');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->unique(['user_id']);
            $table->index(['employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
