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
        Schema::create('periode_monitoring_evaluasi_beasiswa_full', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->enum('semester_akademik', ['ganjil', 'genap']);
            $table->date('tanggal_mulai')->nullable();
            $table->enum('status', ['dibuka', 'ditutup'])->default('dibuka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_monitoring_evaluasi_beasiswa_full');
    }
};
