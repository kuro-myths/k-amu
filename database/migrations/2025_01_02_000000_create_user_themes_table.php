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
        Schema::create('user_themes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Mode: normal, private, tor
            $table->string('mode')->default('normal');

            // Primary Color
            $table->string('primary_color')->default('#3b82f6');

            // Secondary Color
            $table->string('secondary_color')->default('#8b5cf6');

            // Background Color
            $table->string('background_color')->default('#ffffff');

            // Text Color
            $table->string('text_color')->default('#000000');

            // Accent Color
            $table->string('accent_color')->default('#ec4899');

            // Font Style: sans, serif, mono
            $table->string('font_family')->default('sans');

            // Font Size: small, normal, large
            $table->string('font_size')->default('normal');

            // Text Weight: light, normal, bold
            $table->string('font_weight')->default('normal');

            // Dark Mode Enabled
            $table->boolean('dark_mode')->default(false);

            // Compact Mode
            $table->boolean('compact_mode')->default(false);

            $table->timestamps();
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_themes');
    }
};
