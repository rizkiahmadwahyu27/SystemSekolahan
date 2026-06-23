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
        Schema::create('jawaban_siswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hasil_ujian_id')->constrained()->cascadeOnDelete();
            $table->foreignId('soal_id')->constrained()->cascadeOnDelete();

            // untuk PG
            $table->foreignId('jawaban_id')->nullable()->constrained()->nullOnDelete();

            // untuk essay
            $table->text('jawaban_text')->nullable();

            // hasil
            $table->boolean('is_benar')->nullable();
            $table->integer('nilai')->nullable(); // khusus essay

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswas');
    }
};
