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
        Schema::create('penilaian_monitoring', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitoring_id')->constrained('monitoring_evaluasi')->onDelete('cascade');
            $table->foreignId('kepala_prodi_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating')->default(1); // 1-5 Bintang
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_monitoring');
    }
};
