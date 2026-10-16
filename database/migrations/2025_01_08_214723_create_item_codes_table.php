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
        Schema::create('item_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subsidiary_id')->constrained(
                table: 'subsidiaries',
                indexName: 'item_codes_subsidiary_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('slug')->required()->unique();
            $table->string('kode_item');
            $table->string('nama_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_codes');
    }
};
