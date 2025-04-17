<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class GetAllCartProducers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-all-cart-producers';

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
        $unique_cart_producer_names = [];

        $carts = Models\Cart::query()
            ->get();

        foreach( $carts as $cart ) {

            if( !in_array( $cart->getAttribute('cart_properties')['Cart Producer'], $unique_cart_producer_names) ) {
                $unique_cart_producer_names[] = $cart->getAttribute('cart_properties')['Cart Producer'];
            }

        }

        $this->line( implode(", ", $unique_cart_producer_names) );
    }
}
