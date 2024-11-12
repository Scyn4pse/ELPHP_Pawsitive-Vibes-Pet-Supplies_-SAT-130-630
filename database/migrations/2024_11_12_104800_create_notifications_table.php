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
        Schema::create('Notifications', function (Blueprint $table) {
            $table->id('notif_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('notif_user_type');
            $table->string('notif_message', 225);
            $table->timestamps();
            $table->boolean('notif_is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Notifications');
        Schema::table('Notifications', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
