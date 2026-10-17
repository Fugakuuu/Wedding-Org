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
        Schema::create('Katalog_Paket', function (Blueprint $table) {
            $table->increments('Paket_id');
            $table->string('Nama_paket');
            $table->decimal('Harga', 10, 2);
            $table->text('Dekripsi_pkt');
            $table->string('Kategori')->nullable();
            $table->unsignedInteger('Admin_id')->nullable();
            
            $table->foreign('Admin_id')
                  ->references('Admin_id')
                  ->on('Admin')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Katalog_Paket');
    }
};
