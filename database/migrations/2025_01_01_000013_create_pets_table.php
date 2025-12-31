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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->default('Pet');
            $table->enum('pet_type', ['cat', 'dog', 'bird', 'dragon', 'vtuber', 'robot', 'angel', 'demon'])->default('vtuber');
            $table->enum('role_type', ['user', 'leader', 'mastercard', 'tester', 'superadmin'])->nullable();
            $table->integer('level')->default(1);
            $table->integer('experience')->default(0);
            $table->integer('health')->default(100);
            $table->integer('happiness')->default(100);
            $table->integer('energy')->default(100);
            $table->text('biography')->nullable();
            $table->json('stats')->nullable();
            $table->json('abilities')->nullable();
            $table->timestamp('last_interaction')->nullable();
            $table->timestamps();
        });

        // Add pet_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('pet_id')->nullable()->constrained('pets')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor('pets');
        });

        Schema::dropIfExists('pets');
    }
};
