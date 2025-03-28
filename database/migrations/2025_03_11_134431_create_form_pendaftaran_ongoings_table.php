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
        Schema::create('form_pendaftaran_ongoing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('beasiswa_id')->constrained('beasiswa')->onDelete('cascade');

            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->string('departemen');
            $table->integer('semester');
            $table->string('nomor_hp');

            // File Wajib
            $table->string('file_ktm');

            $table->enum('jenis_beasiswa', ['bpel', 'aktivis', 'bpa']);

            // Status
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_admin')->nullable();


            // Indexes
            $table->index(['nim', 'status']);
            $table->index(['beasiswa_id', 'status']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pendaftaran_ongoings');
    }
};
