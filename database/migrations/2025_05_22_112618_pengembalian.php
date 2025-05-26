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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_peminjaman');
            $table->foreign('id_detail_peminjaman')->references('id')->on('detail_peminjaman')->onDelete('cascade');
            $table->string('foto', 300);
            $table->dateTime('tanggal_dikembalikan');
            $table->text('keterangan');
            $table->enum('status',['Ditinjau','Disetujui','Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
