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
        Schema::create('hasil_ujians', function (Blueprint $table) {
            $table->id();

            // 🟢 PERBAIKAN 1: Paksa foreign key mengarah secara spesifik ke tabel 'user_ujians'
            $table->foreignId('user_id')
                  ->constrained('user_ujians') 
                  ->cascadeOnDelete();

            $table->foreignId('ujian_id')->constrained()->cascadeOnDelete();

            // 🟢 PERBAIKAN 2: Tambahkan kolom pilihan jurusan agar data bisa tersimpan
            $table->string('pilihan_1')->nullable();
            $table->string('pilihan_2')->nullable();

            $table->timestamp('mulai')->nullable();
            $table->timestamp('selesai')->nullable();

            $table->decimal('nilai_pg', 5, 2)->nullable();
            $table->decimal('nilai_essay', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_ujians');
    }
};