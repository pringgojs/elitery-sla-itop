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
        Schema::connection('mysql2')->table('ticket', function (Blueprint $table) {
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'resolution_time_real')) {
                $table->integer('resolution_time_real')->default(0);
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'pending_time')) {
                $table->integer('pending_time')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::connection('mysql2')->table('ticket', function (Blueprint $table) {
            $table->dropColumn([
                'resolution_time_real',
                'pending_time',
            ]);
        });
    }
};
