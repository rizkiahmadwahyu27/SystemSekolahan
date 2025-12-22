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
        Schema::create('spmbs', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('tempat_tgl_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('agama', ['islam', 'hindu', 'budha', 'katolik', 'protestan', 'konghuchu']);
            $table->string('status_dalam_keluarga');
            $table->integer('anak_ke');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('asal_sekolah');
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('alamat_ortu');
            $table->string('no_hp_ortu');
            $table->string('minat_kompetensi');
            $table->json('dokumen_pendaftaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmbs');
    }
};
