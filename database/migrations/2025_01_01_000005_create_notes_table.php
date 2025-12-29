<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->longText('content');
            $table->string('category')->nullable();
            $table->string('color')->default('#ffffff');
            $table->boolean('is_pinned')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('is_pinned');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
