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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('transaction_code', 30)->unique();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('processed_by')->nullable()->comment('Admin who processed the transaction');
            $table->enum('transaction_type', ['borrow', 'return']);
            $table->timestamp('transaction_date')->default(now());
            $table->date('due_date');
            $table->timestamp('return_date')->nullable();
            $table->enum('status', ['active', 'returned', 'overdue', 'lost'])->default('active');
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->foreign('processed_by')->references('admin_id')->on('admin')->onDelete('set null');
            $table->index(['transaction_code']);
            $table->index(['member_id']);
            $table->index(['processed_by']);
            $table->index(['status']);
            $table->index(['transaction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
