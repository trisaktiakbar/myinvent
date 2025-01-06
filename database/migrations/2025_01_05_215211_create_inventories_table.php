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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->required()->unique();
            $table->string('kode_item')->required()->unique();
            $table->string('nama_item')->required();
            $table->string('no_pp_manual')->nullable();
            $table->string('no_pr')->nullable();
            $table->integer('kuantitas')->required();
            $table->string('uom')->nullable();
            $table->integer('estimasi_harga')->required();
            $table->text('keterangan_alokasi')->nullable();
            $table->timestamp('waktu_konfirmasi_gudang_pusat')->nullable();
            $table->timestamp('waktu_konfirmasi_gudang_central')->nullable();
            $table->timestamp('waktu_konfirmasi_gudang_site')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
