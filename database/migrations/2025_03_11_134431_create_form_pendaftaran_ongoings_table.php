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
        Schema::create('form_pendaftaran_ongoings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('beasiswa_id')->constrained('beasiswa')->onDelete('cascade');

            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->string('departemen');
            $table->integer('semester');
            $table->string('nomor_hp');

            // File Wajib
            $table->string('file_ktm');
            $table->string('file_transkrip');
            $table->string('file_kk');

            // Data Ekonomi (untuk BPEL)
            $table->string('pekerjaan_ayah')->nullable();
            $table->decimal('gaji_ayah', 12, 2)->nullable();
            $table->string('file_slip_gaji_ayah')->nullable();
            $table->integer('jumlah_tanggungan')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->decimal('gaji_ibu', 12, 2)->nullable();
            $table->string('file_foto_rumah')->nullable();
            $table->string('file_surat_tidak_mampu')->nullable();

            // Data Organisasi (untuk Aktivis)
            $table->text('riwayat_organisasi')->nullable();
            $table->string('file_sk_organisasi')->nullable();

            // Status
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_admin')->nullable();


            // Indexes
            $table->index(['nim', 'status']);
            $table->index(['beasiswa_id', 'status']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pendaftaran_ongoings');
    }
};
