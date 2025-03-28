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
        Schema::create('form_laporan_monitoring_dan_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftaran_beasiswa')->onDelete('cascade'); // Relasi ke pendaftaran beasiswa
            $table->string('nama_mahasiswa');
            $table->string('nim')->unique();
            $table->string('program_studi');
            $table->integer('semester');

            $table->integer('jumlah_sks')->nullable();

            // Skripsi
            $table->boolean('telah_mengajukan_skripsi')->default(false);
            $table->string('judul_skripsi')->nullable();
            $table->boolean('telah_seminar_proposal')->default(false);


            // Keputusan Beasiswa
            $table->enum('status_beasiswa', ['berlanjut', 'berhenti'])->default('berlanjut');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_laporan_monitoring_dan_evaluasis');
    }
};
