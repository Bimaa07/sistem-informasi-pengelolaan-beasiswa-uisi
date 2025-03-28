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
        Schema::create('form_aktivis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_pendaftaran_ongoing_id')
            ->constrained('form_pendaftaran_ongoing')
            ->onDelete('cascade');
      $table->string('transkrip_ips_file');
      $table->text('posisi_kepengurusan');
      $table->string('file_kk');
      $table->json('sk_rektor_files'); // Store multiple SK files
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_aktivis');
    }
};
