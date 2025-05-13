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
            $table->foreignId('penerima_beasiswa_id')->constrained('penerima_beasiswa')->onDelete('cascade');
            $table->foreignId('periode_monitoring_id')->constrained('periode_monitoring')->onDelete('cascade');
            $table->float('ipk');
            $table->float('ips');
            $table->text('prestasi')->nullable();
            $table->text('kegiatan_organisasi')->nullable();
            $table->string('transkrip_file');
            $table->enum('status', ['draft', 'reviewed', 'approved', 'rejected'])->default('draft');
            $table->timestamps();
            $table->unique(['penerima_beasiswa_id', 'periode_monitoring_id']);
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
