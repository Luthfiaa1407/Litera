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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();

            // Tahun pakai integer (lebih aman daripada year)
            $table->integer('year')->nullable();

            // Google Books integration
            $table->string('isbn')->nullable();
            $table->string('google_book_id')->nullable();  // ID dari Google Books API

            // Kategori
            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade');

            // Media
            $table->string('cover')->nullable();      // cover image
            $table->string('file_path')->nullable();  // PDF atau file lain

            // Deskripsi
            $table->text('description')->nullable();

            // Stok
            $table->integer('stock')->default(1);

            // Status buku
            $table->enum('status', ['available', 'unavailable'])
                ->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
