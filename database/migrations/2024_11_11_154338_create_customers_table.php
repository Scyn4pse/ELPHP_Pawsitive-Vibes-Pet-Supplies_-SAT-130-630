<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Customers', function (Blueprint $table) {
            $table->id('cust_id');
        $table->string('cust_name', 255);  
        $table->string('cust_email', 255)->unique();  
        $table->string('cust_password', 225);  
        $table->string('cust_phone', 225)->unique();  
        $table->string('cust_address', 225);  
        $table->string('user_role', 255);
        $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Customers');
        Schema::table('Customers', function (Blueprint $table) {
            $table->dropTimestamps(); 
        });
    }
};
