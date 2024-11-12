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
        Schema::create('OrderItem', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('order_item_quantity');
            $table->double('order_item_price');

            $table->foreign('order_id')->references('order_id')->on('Order')
                    ->onDelete('cascade');
            $table->foreign('product_id')->references('prod_id')->on('Product')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OrderItem');
    }
};
