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
        Schema::create('planting_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('created_by');
            $table->uuid('activity_type_id');
            $table->string('activity_organizer')->nullable();
            $table->uuid('regency_id');
            $table->uuid('district_id');
            $table->uuid('village_id');
            $table->string('area_detail')->nullable();
            $table->uuid('seed_source_id');
            $table->uuid('budget_source_id');
            $table->float('land_area', 10, 2)->default(0);
            $table->string('pic_name')->nullable();
            $table->string('activity_note')->nullable();
            $table->string('activity_image')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->dateTime('date_of_activity')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('activity_type_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('regency_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('seed_source_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('budget_source_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('planting_activities');
    }
};
