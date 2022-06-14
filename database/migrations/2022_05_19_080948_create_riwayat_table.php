<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_pesanan');
            $table->json('list_pesanan');
            $table->json('jumlah_pesanan');
            $table->string('nama_pemesan');
            $table->string('harga_pesanan');
            $table->enum('status', ['Diproses','Dikirim','Diterima', 'Penilaian']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat');
    }
};
