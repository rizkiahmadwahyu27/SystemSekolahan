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
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nis');
            $table->string('nama');
            $table->string('kode_kelas');
            $table->string('nama_kelas');
            $table->string('keterangan');
            $table->string('user_create');
            $table->string('edit_user');
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_kelas');
    }
};
