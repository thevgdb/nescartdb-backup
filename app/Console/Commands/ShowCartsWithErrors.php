<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class ShowCartsWithErrors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-carts-with-errors';

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
            ->where('errors_occurred_when_saving_images_locally', true)
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

//            $this->comment( str_repeat("=", strlen($current_cart_comment_text) ) );
            $this->comment( $current_cart_comment_text );
//            $this->comment(  );

            $cart->setAttribute('errors_occurred_when_saving_images_locally', false);
            $cart->save();


        }
    }
}
