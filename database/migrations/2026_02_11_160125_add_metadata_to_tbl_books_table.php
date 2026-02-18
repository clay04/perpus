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
        Schema::table('tbl_books', function (Blueprint $table) {
            $table->string('penerbit')->nullable()->after('penulis');
            $table->year('tahun_terbit')->nullable()->after('penerbit');
            $table->string('kota_terbit')->nullable()->after('tahun_terbit');
            $table->string('edisi')->nullable()->after('kota_terbit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_books', function (Blueprint $table) {
            $table->dropColumn([
                'penerbit',
                'tahun_terbit',
                'kota_terbit',
                'edisi'
            ]);
        });
    }
};
