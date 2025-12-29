<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user'); // superadmin, mastercard, leader, user, tester
            $table->string('user_type')->nullable(); // siswa, orang_tua, alumni (untuk user biasa)
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('cv')->nullable(); // path ke CV file
            $table->integer('level')->default(1); // untuk tester
            $table->integer('points')->default(0); // gamification
            $table->timestamp('last_login_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'user_type',
                'bio',
                'avatar',
                'phone',
                'address',
                'cv',
                'level',
                'points',
                'last_login_at'
            ]);
            $table->dropSoftDeletes();
        });
    }
};
