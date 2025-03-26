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
        Schema::create('report_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('seed_id');
            $table->uuid('report_id');
            $table->integer('dead_amount')->default(0); // jumlah yg mati
            $table->integer('alive_amount')->default(0); // jumlah yg hidup
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('seed_id')->references('id')->on('seeds')->onDelete('cascade');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_details');
    }
};
