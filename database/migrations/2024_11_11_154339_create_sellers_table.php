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
        Schema::create('Seller', function (Blueprint $table) {
            $table->id('seller_id');
            $table->string('seller_name', 255);
            $table->string('seller_email', 255)->unique();
            $table->string('seller_password', 255);
            $table->string('seller_phone', 255)->unique();
            $table->string('seller_store_name', 255);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Seller');
        Schema::table('Seller', function (Blueprint $table) {
        $table->dropTimestamps(); // This will remove the 'created_at' and 'updated_at' columns
    });
    }
};
