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
        Schema::create('akademik_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_monev_id')->constrained('form_laporan_monitoring_dan_evaluasis')->onDelete('cascade');
            $table->integer('semester');
            $table->decimal('ip', 3, 2)->nullable();
            $table->integer('sks_semester')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademik_mahasiswas');
    }
};
