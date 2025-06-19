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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade'); // Relasi ke tabel pegawai
            $table->date('tanggal_mulai_cuti');
            $table->date('tanggal_selesai_cuti');
            $table->integer('durasi_cuti'); // dalam satuan hari
            $table->string('tipe_cuti'); // cuti tahunan, cuti sakit, cuti melahirkan, lainnya
            $table->text('alasan_cuti');
            $table->enum('status_pengajuan', ['Baru', 'Diproses', 'Diterima', 'Ditolak'])->default('Baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
