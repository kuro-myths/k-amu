<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tester_id')->constrained('users')->onDelete('cascade');
            $table->string('feature_name');
            $table->text('test_description')->nullable();
            $table->string('status')->default('in_progress'); // in_progress, passed, failed, inconclusive
            $table->integer('percentage')->default(0);
            $table->json('test_cases')->nullable();
            $table->text('notes')->nullable();
            $table->json('environment')->nullable(); // browser, os, etc
            $table->softDeletes();
            $table->timestamps();

            $table->index('tester_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
