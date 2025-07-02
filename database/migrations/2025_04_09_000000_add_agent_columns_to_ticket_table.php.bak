<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::connection('mysql2')->table('ticket', function (Blueprint $table) {
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l1_id')) {
                $table->integer('agent_l1_id')->default(0);
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l1_name')) {
                $table->string('agent_l1_name', 255)->nullable();
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l1_response_time')) {
                $table->integer('agent_l1_response_time')->default(0);
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l2_id')) {
                $table->integer('agent_l2_id')->default(0);
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l2_name')) {
                $table->string('agent_l2_name', 255)->nullable();
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l2_response_time')) {
                $table->integer('agent_l2_response_time')->default(0);
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'agent_l2_resolution_time')) {
                $table->integer('agent_l2_resolution_time')->default(0);
            }
            if (!Schema::connection('mysql2')->hasColumn('ticket', 'sla_last_check')) {
                $table->timestamp('sla_last_check')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::connection('mysql2')->table('ticket', function (Blueprint $table) {
            $table->dropColumn([
                'agent_l1_id',
                'agent_l1_name',
                'agent_l1_response_time',
                'agent_l2_id',
                'agent_l2_name',
                'agent_l2_response_time',
                'agent_l2_resolution_time',
                'sla_last_check',
            ]);
        });
    }
};
