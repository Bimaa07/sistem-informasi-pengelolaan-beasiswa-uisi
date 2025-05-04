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
        Schema::create('monitoring_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('periode_monitoring_evaluasi_id')->constrained('periode_monitoring_evaluasi_beasiswa_full')->onDelete('cascade');
            $table->enum('status', ['draft', 'submitted', 'reviewed_kaprodi', 'reviewed_admin', 'selesai'])->default('draft');
            $table->boolean('review_kaprodi_selesai')->default(false);
            $table->boolean('review_admin_selesai')->default(false);
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_evaluasi');
    }
};
