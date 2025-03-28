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
        Schema::create('form_bpa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_pendaftaran_ongoing_id')
                  ->constrained('form_pendaftaran_ongoing')
                  ->onDelete('cascade');
            $table->string('transkrip_ips_file');
            $table->string('pekerjaan_ayah');
            $table->decimal('gaji_ayah', 12, 2);
            $table->string('file_kk');
            $table->string('pekerjaan_ibu');
            $table->decimal('gaji_ibu', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_bpa');
    }
};
