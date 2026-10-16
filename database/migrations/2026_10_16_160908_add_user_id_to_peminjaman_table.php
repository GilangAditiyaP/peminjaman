<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('peminjaman', 'user_id')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('peminjaman', 'user_id')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }
    }
};