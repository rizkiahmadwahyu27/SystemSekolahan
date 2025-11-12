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
        Schema::create('data_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('no_kk');
            $table->string('nis');
            $table->string('nisn');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->text('alamat');
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('sekolah_asal');
            $table->integer('anak_ke');
            $table->string('no_hp');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->text('alamat_ortu');
            $table->string('no_hp_ortu');
            $table->string('created_by');
            $table->string('edited_by');
            $table->integer('id_conf');
            $table->integer('id_user_input');
            $table->integer('id_user_edit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswas');
    }
};
