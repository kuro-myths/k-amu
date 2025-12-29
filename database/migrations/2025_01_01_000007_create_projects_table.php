<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leader_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('planning'); // planning, in_progress, completed, on_hold
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('progress')->default(0); // 0-100
            $table->json('team_members')->nullable(); // array of user ids
            $table->softDeletes();
            $table->timestamps();

            $table->index('leader_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
