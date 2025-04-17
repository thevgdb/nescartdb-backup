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
        Schema::create('cart_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_id')
                ->nullable()
                ->constrained()
                ->references('id')->on('carts');

//            $table->string('submitter');
            $table->foreignId('submitter_id')
                ->nullable()
                ->constrained()
                ->references('id')->on('users');

            $table->string('position');
            $table->string('nescartdb_thumbnail_src');
            $table->string('nescartdb_src');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_images');
    }
};
