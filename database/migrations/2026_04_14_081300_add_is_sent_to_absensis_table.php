<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->tinyInteger('is_sent')->default(0)->after('keterangan');
            $table->string('status_sent')->nullable()->after('is_sent');
            $table->timestamp('sent_at')->nullable()->after('status_sent');
        });
    }

    public function down()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['is_sent', 'status_sent', 'sent_at']);
        });
    }
};