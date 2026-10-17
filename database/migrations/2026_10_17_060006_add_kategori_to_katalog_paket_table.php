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
        Schema::table('Katalog_Paket', function (Blueprint $table) {
            if (!Schema::hasColumn('Katalog_Paket', 'Kategori')) {
                $table->string('Kategori', 20)->nullable()->after('Dekripsi_pkt');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Katalog_Paket', function (Blueprint $table) {
            if (Schema::hasColumn('Katalog_Paket', 'Kategori')) {
                $table->dropColumn('Kategori');
            }
        });
    }
};