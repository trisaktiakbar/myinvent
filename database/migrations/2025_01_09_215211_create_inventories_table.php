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
            $table->foreignId('item_code_id')->constrained(
                table: 'item_codes',
                indexName: 'inventories_item_code_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_pp_manual')->nullable();
            $table->string('no_pr')->nullable();
            $table->string('no_po')->nullable();
            $table->integer('kuantitas')->required();
            $table->string('uom')->nullable();
            $table->integer('estimasi_harga')->required();
            $table->text('keterangan_alokasi')->nullable();
            $table->timestamp('waktu_konfirmasi_time_planner_ho')->nullable();
            $table->timestamp('waktu_konfirmasi_purchasing')->nullable();
            $table->timestamp('waktu_konfirmasi_gudang_pusat')->nullable();
            $table->timestamp('waktu_konfirmasi_gudang_central')->nullable();
            $table->timestamp('waktu_konfirmasi_gudang_site')->nullable();
            $table->boolean('pengiriman_langsung_gudang_site')->required()->default(false);
            $table->string('no_pengiriman')->nullable();
            $table->boolean('pembelian_lokal')->required()->default(0);
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
