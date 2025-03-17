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
        Schema::create('form_laporan_monitoring_dan_evaluasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftaran_beasiswa')->onDelete('cascade'); // Relasi ke pendaftaran beasiswa
            $table->string('nama_mahasiswa');
            $table->string('nim')->unique();
            $table->string('program_studi');
            $table->integer('semester');

            // Akademik
            $table->decimal('ip_semester_1', 3, 2)->nullable();
            $table->decimal('ip_semester_2', 3, 2)->nullable();
            $table->decimal('ip_semester_3', 3, 2)->nullable();
            $table->decimal('ip_semester_4', 3, 2)->nullable();
            $table->decimal('ip_semester_5', 3, 2)->nullable();
            $table->decimal('ip_semester_6', 3, 2)->nullable();
            $table->decimal('ip_semester_7', 3, 2)->nullable();
            $table->decimal('ip_semester_8', 3, 2)->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->integer('jumlah_sks')->nullable();

            // Skripsi
            $table->boolean('telah_mengajukan_skripsi')->default(false);
            $table->string('judul_skripsi')->nullable();
            $table->boolean('telah_seminar_proposal')->default(false);

            // Prestasi dan Karya Ilmiah
            $table->integer('jumlah_skem')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('karya_ilmiah')->nullable();

            // Kegiatan Kemahasiswaan
            $table->text('organisasi')->nullable();
            $table->text('kegiatan_kemahasiswaan')->nullable();
            $table->text('kontribusi_promosi_departemen')->nullable();

            // Keputusan Beasiswa
            $table->enum('status_beasiswa', ['berlanjut', 'berhenti'])->default('berlanjut');
            $table->text('catatan_kepala_departemen')->nullable();

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
