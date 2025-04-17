<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class GetCartProfilesWithEmptyCartProducerNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-cart-profiles-with-empty-cart-producer-names';

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
        $cart_ids_with_empty_cart_producer_names = [];

        $carts = Models\Cart::query()
            ->get();

        foreach( $carts as $cart ) {

            if( strlen($cart->getAttribute('cart_properties')['Cart Producer']) == 0 ) {
                $cart_ids_with_empty_cart_producer_names[] = $cart->getAttribute('cart_id');
            }

        }

        $this->line( implode(", ", $cart_ids_with_empty_cart_producer_names) );

    }
}
