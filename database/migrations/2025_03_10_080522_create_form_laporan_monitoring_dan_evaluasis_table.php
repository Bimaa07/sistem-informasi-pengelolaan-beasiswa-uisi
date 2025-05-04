<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_monev', function (Blueprint $table) {  // Shortened table name
            $table->id();
            $table->foreignId('monitoring_evaluasi_id')
                  ->constrained('monitoring_evaluasi')
                  ->onDelete('cascade');
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

    public function down(): void
    {
        Schema::dropIfExists('form_monev');
    }
};
