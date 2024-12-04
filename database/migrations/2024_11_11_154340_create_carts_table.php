<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('cust_id')->constrained()->onDelete('cascade');;
            $table->timestamps();

            $table->foreign('cust_id')->references('cust_id')->on('Customers')
                    ->onDelete('cascade');
            $table->foreign('cust_id')->references('cust_id')->on('Customers')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Carts');
        Schema::table('Carts', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
