<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class GetImagesWithoutThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-images-without-thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $carts_with_no_cart_front_image = [];

        $carts = Models\Cart::query()
            ->get();

        foreach( $carts as $cart ) {

            if( !$cart->hasImage('cart_front') ) {
                $carts_with_no_cart_front_image[] = $cart;
            }

        }

        $this->line("Carts With No Front Image:");
        foreach( $carts_with_no_cart_front_image as $cart_with_no_cart_front_image ) {
            $this->line( $cart_with_no_cart_front_image->publicUrl() );
        }
//        $this->line( implode(", ", $carts_with_no_cart_front_image) );


    }
}
