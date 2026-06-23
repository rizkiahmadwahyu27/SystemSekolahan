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
        Schema::create('user_ujians', function (Blueprint $table) {
            $table->id();

            // data utama
            $table->string('nama');
            $table->string('no_peserta')->unique();
            $table->string('password');

            // identitas
            $table->string('nis')->nullable();
            $table->string('kelas')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('sesi')->nullable();

            // keamanan
            $table->rememberToken();
            $table->boolean('is_active')->default(true);

            // anti kecurangan
            $table->string('device_id')->nullable();
            $table->string('session_id')->nullable(); // 🔥 penting!
            $table->boolean('is_login')->default(false);

            // tambahan
            $table->string('foto')->nullable();

            // tracking
            $table->timestamp('last_login')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ujians');
    }
};
