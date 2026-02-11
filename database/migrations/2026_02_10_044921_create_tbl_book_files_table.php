<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_book_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('tbl_books')->cascadeOnDelete();
            $table->string('file_name');
            $table->string('file_path');
            $table->enum('file_type', ['pdf', 'epub'])->default('pdf');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->integer('total_pages')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_book_files');
    }
};
