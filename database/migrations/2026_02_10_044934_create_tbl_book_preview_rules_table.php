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
        Schema::create('tbl_book_preview_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bood_id')->constrained('tbl_books')->cascadeOnDelete();
            $table->integer('preview_pages');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_book_preview_rules');
    }
};
