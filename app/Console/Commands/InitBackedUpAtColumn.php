<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class InitBackedUpAtColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-backed-up-at-column';

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
        $carts = Models\Cart::query()
            ->where('all_images_saved_locally', true)
            ->get();

        $current_count = 0;
        foreach($carts as $cart) {
            $current_count++;

            $current_cart_comment_text = (
                    $current_count . "/" . count($carts)) . " "
                . $cart->getAttribute('game_title')
                . " ( " . $cart->publicUrl()
                . " | https://nescartdb.com/profile/view/" . $cart->getAttribute('cart_id') . "/" . $cart->getAttribute('cart_url_slug')
                . " )";


            $cart->setAttribute( 'backed_up_at', $cart->getAttribute('updated_at') );
            $cart->save();


        }


    }
}
