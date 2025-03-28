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
        Schema::create('prestasi_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_monev_id')->constrained('form_laporan_monitoring_dan_evaluasi')->onDelete('cascade');
            $table->enum('jenis', ['prestasi', 'karya_ilmiah', 'organisasi', 'kegiatan', 'kontribusi_promosi_departemen']);
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->string('bukti_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_mahasiswas');
    }
};
