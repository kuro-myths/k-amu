<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('recipient_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->nullable(); // untuk group chat
            $table->text('content');
            $table->string('type')->default('text'); // text, image, file, code
            $table->timestamp('read_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('sender_id');
            $table->index('recipient_id');
            $table->index('room_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
