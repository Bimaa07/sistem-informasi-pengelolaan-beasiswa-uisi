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
            $table->foreignId('monitoring_evaluasi_id')->constrained('monitoring_evaluasi')->onDelete('cascade');
            $table->foreignId('penilai_id')->constrained('users')->onDelete('cascade');
            $table->enum('role_penilai', ['kaprodi', 'admin']);
            $table->integer('rating')->default(1); // 1-5
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
