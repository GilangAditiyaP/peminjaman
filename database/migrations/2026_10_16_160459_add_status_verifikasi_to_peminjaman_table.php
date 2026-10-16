<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('status_verifikasi')->default('menunggu')->after('status_dipinjam');
            $table->foreignId('user_id')->nullable()->after('barang_id')->constrained('users')->nullOnDelete();
        });

        // Pinjaman lama yang sudah aktif dianggap telah disetujui.
        DB::table('peminjaman')->where('status_dipinjam', true)->update(['status_verifikasi' => 'disetujui']);
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('status_verifikasi');
        });
    }
};
