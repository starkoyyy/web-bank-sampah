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
            if (!Schema::hasColumn('transaksi_tarik', 'metode_penarikan')) {
                $table->enum('metode_penarikan', ['Tunai', 'Transfer', 'E-Wallet'])->default('Tunai');
            }
            if (!Schema::hasColumn('transaksi_tarik', 'detail_tujuan')) {
                $table->string('detail_tujuan')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_tarik', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi_tarik', 'metode_penarikan')) {
                $table->dropColumn('metode_penarikan');
            }
            if (Schema::hasColumn('transaksi_tarik', 'detail_tujuan')) {
                $table->dropColumn('detail_tujuan');
            }
        });
    }
};
