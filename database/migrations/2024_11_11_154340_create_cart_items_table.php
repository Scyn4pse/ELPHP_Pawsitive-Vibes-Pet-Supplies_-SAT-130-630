<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
        {
            Schema::create('CartItems', function (Blueprint $table) {
                $table->id('cart_item_id');
                $table->unsignedBigInteger('prod_id');
                $table->integer('cart_item_quantity');
                $table->double('cart_item_price');

                $table->foreign('prod_id')->references('prod_id')->on('Products')
                        ->onDelete('cascade');
            });
        }
    public function down(): void
    {
        Schema::dropIfExists('CartItems');
    }
};
