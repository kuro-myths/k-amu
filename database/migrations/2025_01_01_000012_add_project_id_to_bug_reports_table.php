<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bug_reports', function (Blueprint $table) {
            $table->foreignId('project_id')
                ->nullable()
                ->after('reporter_id')
                ->constrained('projects')
                ->onDelete('set null');

            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::table('bug_reports', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropIndex(['project_id']);
            $table->dropColumn('project_id');
        });
    }
};
