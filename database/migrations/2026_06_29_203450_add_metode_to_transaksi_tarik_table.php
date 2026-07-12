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
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            $table->enum('metode_penarikan', ['Tunai', 'Transfer', 'E-Wallet'])->default('Tunai')->after('jumlah_tarik');
            $table->string('detail_tujuan')->nullable()->after('metode_penarikan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            $table->dropColumn(['metode_penarikan', 'detail_tujuan']);
        });
    }
};
