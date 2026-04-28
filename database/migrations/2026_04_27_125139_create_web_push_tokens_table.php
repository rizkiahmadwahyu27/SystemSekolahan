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
        Schema::create('web_push_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->index();
            $table->string('endpoint', 512)->unique();
            $table->text('p256dh');
            $table->text('auth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_push_tokens');
    }
};
