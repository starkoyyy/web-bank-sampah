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
        Schema::table('transaksi_setor', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi_setor', 'status')) {
                $table->string('status', 50)->default('disetujui');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_setor', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi_setor', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
