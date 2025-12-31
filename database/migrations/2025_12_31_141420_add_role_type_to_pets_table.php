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
        Schema::table('pets', function (Blueprint $table) {
            // Kolom role_type sudah ada di create_pets_table
            // Migration ini hanya placeholder untuk safety
            if (!Schema::hasColumn('pets', 'role_type')) {
                $table->enum('role_type', ['user', 'leader', 'mastercard', 'tester', 'superadmin'])->nullable()->after('pet_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('role_type');
        });
    }
};
