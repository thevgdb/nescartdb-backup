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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id');
            $table->string('cart_url_slug');
            $table->string('game_title');
            $table->string('game_version');
            $table->string('game_subtitle');
            $table->string('region');
            $table->string('publisher');
            $table->string('catalog_id');
            $table->string('pcb_name');
            $table->string('submitter');
            $table->datetime('submitted')->nullable()->default(null);
            $table->datetime('backed_up_at')->nullable()->default(null);
            $table->string('number_of_times_cart_verified');
            $table->json('images')->nullable();
            $table->json('cart_details')->nullable();
            $table->json('cart_properties')->nullable();
            $table->json('rom_details')->nullable();
            $table->json('pcb_details')->nullable();
            $table->json('detailed_chip_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
