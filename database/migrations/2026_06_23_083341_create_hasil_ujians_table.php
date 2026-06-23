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

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ujian_id')->constrained()->cascadeOnDelete();

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
