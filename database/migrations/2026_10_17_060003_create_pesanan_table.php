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
        Schema::create('Pesanan', function (Blueprint $table) {
            $table->increments('Pesanan_id');
            $table->unsignedInteger('Paket_id');
            $table->string('Nama_pemesan');
            $table->string('Email_pemesan');
            $table->string('No_WA')->nullable();
            $table->date('Tanggal_acara');
            $table->text('Catatan')->nullable();
            $table->string('Status')->default('pending');
            $table->unsignedInteger('Admin_id')->nullable();
            
            $table->foreign('Paket_id')
                  ->references('Paket_id')
                  ->on('Katalog_Paket')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pesanan');
    }
};
