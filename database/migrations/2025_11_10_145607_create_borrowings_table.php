<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->date('borrow_date');
            $table->date('return_date')->nullable();
            
            // Ubah enum status untuk sistem approval
            $table->enum('status', ['pending', 'approved', 'rejected', 'active', 'returned', 'auto_returned'])->default('pending');
            
            // Tambah kolom untuk sistem approval
            $table->text('admin_notes')->nullable();
            $table->timestamp('request_date')->useCurrent();
            $table->timestamp('approved_date')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
};