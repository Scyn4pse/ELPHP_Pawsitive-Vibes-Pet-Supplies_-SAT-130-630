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
        Schema::create('Cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('cust_id');
            $table->timestamps();

            $table->foreign('cust_id')->references('cust_id')->on('Customer')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Cart');
        Schema::table('Cart', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
