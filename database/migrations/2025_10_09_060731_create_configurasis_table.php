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
        Schema::create('configurasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sekolah');
            $table->string('nama_sekolah');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('semester');
            $table->string('tahun_ajaran')->unique();
            $table->enum('status', ['aktif','non-aktif'])->default('aktif');
            $table->string('user_create');
            $table->string('edit_user');
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
        Schema::dropIfExists('configurasis');
    }
};
