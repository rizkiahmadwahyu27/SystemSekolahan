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
        Schema::create('data_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('kelas_x');
            $table->string('nama_wali_kelas_x');
            $table->integer('id_kelas_x');
            $table->string('kelas_xi');
            $table->string('nama_wali_kelas_xi');
            $table->integer('id_kelas_xi');
            $table->string('kelas_xii');
            $table->string('nama_wali_kelas_xii');
            $table->integer('id_kelas_xii');
            $table->integer('total_siswa');
            $table->integer('jlh_siswa');
            $table->integer('jlh_siswi');
            $table->string('keterangan');
            $table->string('user_input');
            $table->string('user_edit');
            $table->string('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelas');
    }
};
