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
        Schema::create('Order', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('cust_id');
            $table->date('order_date');
            $table->integer('order_total');
            $table->string('order_status',225);
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
        Schema::dropIfExists('Order');
        Schema::table('Order', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
