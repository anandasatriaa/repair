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
        Schema::create('product_service_serials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_service_id');
            $table->string('serial_number');
            $table->timestamps();

            $table->foreign('product_service_id')
                ->references('id')->on('product_services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_service_serials');
    }
};
