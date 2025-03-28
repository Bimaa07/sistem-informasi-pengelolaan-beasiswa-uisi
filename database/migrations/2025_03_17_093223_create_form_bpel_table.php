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
        Schema::create('form_bpel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_pendaftaran_ongoing_id')
                  ->constrained('form_pendaftaran_ongoing')
                  ->onDelete('cascade');
            $table->string('transkrip_ips_file');
            $table->string('kartu_keluarga_file');
            $table->string('pekerjaan_ayah');
            $table->decimal('gaji_ayah', 12, 2);
            $table->string('slip_gaji_ayah_file');
            $table->integer('jumlah_tanggungan_ayah');
            $table->string('pekerjaan_ibu');
            $table->decimal('gaji_ibu', 12, 2)->nullable();
            $table->json('foto_rumah_files'); // Store multiple file paths
            $table->string('surat_keterangan_tidak_mampu_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_bpel');
    }
};
