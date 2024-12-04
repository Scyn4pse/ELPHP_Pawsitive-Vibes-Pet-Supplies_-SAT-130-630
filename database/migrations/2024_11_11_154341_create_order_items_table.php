<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('OrderItems', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('order_item_quantity');
            $table->double('order_item_price');
            
            $table->foreign('product_id')->references('prod_id')->on('Products')
                    ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('OrderItems');
    }
};
