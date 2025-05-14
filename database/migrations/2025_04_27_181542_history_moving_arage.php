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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('produk');
            $table->integer('jumlah_1');
            $table->integer('jumlah_2');
            $table->integer('jumlah_3');
            $table->integer('prediksi');
            $table->timestamp('tanggal_prediksi')->default(DB::raw('CURRENT_TIMESTAMP'));

            // Menambahkan kolom user_id sebagai foreign key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menambahkan foreign key ke tabel 'users'
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
