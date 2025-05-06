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
        Schema::create('pendaftaran_beasiswa_ongoing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beasiswa_id')->constrained('beasiswa')->onDelete('cascade');
            $table->enum('status', ['aktif', 'nonaktif', 'ditutup'])->default('aktif');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('content')->nullable();
            $table->string('tahun_ajaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_beasiswa_ongoing');
    }
};
