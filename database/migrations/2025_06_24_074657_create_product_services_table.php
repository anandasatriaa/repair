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
        Schema::create('product_services', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->nullable();
            $table->string('type_product');
            $table->text('problem');
            $table->string('name_customer');
            $table->string('email_customer');
            $table->string('handphone_customer');
            $table->string('receipt')->nullable();
            $table->enum('category', ['CTEK', 'RUPES', 'NOCO']);
            $table->dateTime('date');
            $table->string('type_service')->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->enum('status', ['ON PROGRESS', 'DONE'])->default('ON PROGRESS');
            $table->text('actual_problem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_services');
    }
};
