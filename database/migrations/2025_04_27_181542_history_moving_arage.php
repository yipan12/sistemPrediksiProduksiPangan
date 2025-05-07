<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('History', function (Blueprint $table) {
            $table->id();
            $table->string('produk');
            $table->string('jumlah_sebelumnya');
            $table->integer('prediksi');
            $table->timestamp('tanggal_prediksi')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('History');
    }
};
