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
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->unsignedBigInteger('user_id');
            $table->string('member_code', 20)->unique();
            $table->date('join_date')->default(now());
            $table->date('expired_date')->nullable();
            $table->integer('max_borrow_limit')->default(5);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->unique(['user_id']);
            $table->index(['member_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
