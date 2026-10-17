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
        Schema::table('Pesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('Pesanan', 'No_WA')) {
                $table->string('No_WA', 20)->nullable()->after('Email_pemesan');
            }
            if (!Schema::hasColumn('Pesanan', 'Catatan')) {
                $table->text('Catatan')->nullable()->after('Tanggal_acara');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Pesanan', function (Blueprint $table) {
            if (Schema::hasColumn('Pesanan', 'No_WA')) {
                $table->dropColumn('No_WA');
            }
            if (Schema::hasColumn('Pesanan', 'Catatan')) {
                $table->dropColumn('Catatan');
            }
        });
    }
};