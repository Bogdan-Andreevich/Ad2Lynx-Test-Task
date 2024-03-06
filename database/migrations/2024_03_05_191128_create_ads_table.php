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
        Schema::create('ads', function (Blueprint $table) {
            $table->unsignedBigInteger('ad_id')->primary();
            $table->unsignedInteger('impressions');
            $table->unsignedInteger('clicks');
            $table->unsignedInteger('unique_clicks');
            $table->unsignedInteger('leads');
            $table->unsignedInteger('conversion');
            $table->double('roi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
