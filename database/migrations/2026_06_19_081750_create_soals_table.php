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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ujian_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_soals')->nullOnDelete();

            $table->text('pertanyaan');
            $table->string('gambar')->nullable(); // gambar soal

            $table->enum('tipe', ['pg', 'essay']); // 🔥 penting

            // khusus essay (opsional)
            $table->text('kunci_jawaban')->nullable();

            // bobot nilai
            $table->integer('bobot')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
