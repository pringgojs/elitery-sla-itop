<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('planting_activity_seeds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('seed_id');
            $table->uuid('planting_activity_id');
            $table->integer('amount')->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('seed_id')->references('id')->on('seeds')->onDelete('cascade');
            $table->foreign('planting_activity_id')->references('id')->on('planting_activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('planting_activity_seeds');
    }
};
