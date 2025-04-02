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
        Schema::create('missing_carts', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('catalog_id');
            $table->string('game_title');
            $table->string('game_subtitle');
            $table->string('released');
            $table->string('publisher');
            $table->string('system');
            $table->string('class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_carts');
    }
};
