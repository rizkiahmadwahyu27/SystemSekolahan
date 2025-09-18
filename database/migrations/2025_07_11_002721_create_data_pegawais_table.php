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
        Schema::create('data_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('id_pegawai');
            $table->string('id_pegawai_mutasi');
            $table->string('nuptk');
            $table->string('nip');
            $table->string('nik');
            $table->string('nomor_sertif_pendidik');
            $table->string('nama_pegawai');
            $table->string('pendidikan_akhir');
            $table->string('jurusan');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('agama');
            $table->string('pangkat_or_golongan');
            $table->string('jabatan');
            $table->string('tugas_tambahan');
            $table->string('nama_instansi');
            $table->string('nama_instansi_cab');
            $table->text('mata_pelajaran_1');
            $table->text('mata_pelajaran_2');
            $table->text('mata_pelajaran_3');
            $table->text('mata_pelajaran_4');
            $table->text('mata_pelajaran_5');
            $table->text('mata_pelajaran_6');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('user_input');
            $table->string('user_edit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawais');
    }
};
