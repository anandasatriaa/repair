<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_services', function (Blueprint $table) {
            DB::statement("ALTER TABLE product_services CHANGE COLUMN status status ENUM('ON PROGRESS', 'APPROVAL CUSTOMER', 'DONE') NOT NULL DEFAULT 'ON PROGRESS'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_services', function (Blueprint $table) {
            DB::statement("ALTER TABLE product_services CHANGE COLUMN status status ENUM('ON PROGRESS', 'DONE') NOT NULL DEFAULT 'ON PROGRESS'");
        });
    }
};
