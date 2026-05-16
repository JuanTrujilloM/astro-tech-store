<?php

/**
 * Legacy databases may have an orders table without user_id (old migration).
 * Aligns with App\Models\Order and astro_tech_db_seed.sql.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('orders', 'user_id')) {
            Schema::disableForeignKeyConstraints();
            DB::table('items')->delete();
            DB::table('orders')->delete();
            Schema::enableForeignKeyConstraints();

            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->after('id');
            });

            Schema::table('orders', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        DB::statement('ALTER TABLE `orders` MODIFY `total` INT NOT NULL');
    }

    public function down(): void
    {
        // Non-reversible without losing data shape; legacy installs are uncommon.
    }
};
