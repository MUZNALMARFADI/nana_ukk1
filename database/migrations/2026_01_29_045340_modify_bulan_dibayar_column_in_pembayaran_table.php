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
        Schema::table('pembayaran', function (Blueprint $table) {
            // Ubah kolom bulan_dibayar menjadi VARCHAR(20)
            $table->string('bulan_dibayar', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Kembalikan ke ukuran semula jika rollback
            $table->string('bulan_dibayar', 10)->change();
        });
    }
};