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
        Schema::create('options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name'); // Slahung
            $table->string('key')->nullable(); // untuk kecamatan, bisa nullable, untuk status data: draf, disetujui, dll 
            $table->string('type'); // kecamatan, jabatan, status kerja, status data
            $table->text('extra')->nullable(); // untuk tambahan kolom dengan serialize
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
