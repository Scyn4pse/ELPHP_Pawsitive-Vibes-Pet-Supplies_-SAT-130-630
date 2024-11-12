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
        Schema::create('Product', function (Blueprint $table) {
            $table->id('prod_id');
            $table->unsignedBigInteger('seller_id');
            $table->string('prod_name', 225)->unique();
            $table->string('prod_image', 225)->unique();
            $table->string('prod_description', 225)->nullable(); 
            $table->double('prod_price');
            $table->integer('prod_quantity');
            $table->timestamps();

            $table->foreign('seller_id')->references('seller_id')->on('Seller')
                  ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Product');
        Schema::table('Product', function (Blueprint $table) {
            $table->dropTimestamps(); // This will remove the 'created_at' and 'updated_at' columns
        });
    }
};
