<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->char('kode', 6);
            $table->enum('kategori', array('kendaraan', 'ruang', 'gedung', 'barang'));
            $table->string('nama');
            $table->enum('keperluan', array('pribadi', 'tugas', 'internal', 'eksternal'));
            $table->string('lampiran')->nullable();
            $table->text('kegiatan');
            $table->string('tanggal_awal');
            $table->string('tanggal_akhir');
            $table->string('jam_awal');
            $table->string('jam_akhir');
            $table->string('jumlah')->nullable();
            $table->boolean('is_sopir')->default(false);
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->restrictOnDelete();
            $table->unsignedBigInteger('sopir_id')->nullable();
            $table->foreign('sopir_id')->references('id')->on('sopirs')->restrictOnDelete();
            $table->string('keterangan');
            $table->string('telp');
            $table->enum('status', array('menunggu', 'proses', 'konfirmasi', 'setuju', 'selesai', 'batal'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
