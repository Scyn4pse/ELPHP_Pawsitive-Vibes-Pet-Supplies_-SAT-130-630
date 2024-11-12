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
            Schema::create('CartItem', function (Blueprint $table) {
                $table->id('cart_item_id');
                $table->unsignedBigInteger('cart_id');
                $table->unsignedBigInteger('prod_id');
                $table->integer('cart_quantity');
                $table->double('cart_price');

                $table->foreign('cart_id')->references('cart_id')->on('Cart')
                        ->onDelete('cascade');
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CartItem');
    }
};
