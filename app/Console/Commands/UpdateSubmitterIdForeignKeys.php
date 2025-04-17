<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class UpdateSubmitterIdForeignKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-submitter-id-foreign-keys';

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
        // 23, 24, 29
        $new_fks_map = [
            "23" => 40,
            "24" => 41,
            "29" => 42,
        ];
        $submitter_ids = [23,24,29];


        $carts = Models\Cart::query()
            ->whereIn('submitter_id', $submitter_ids)
            ->get();
        foreach( $carts as $cart ) {
            $current_submitter_id = $cart->getAttribute('submitter_id');

            $cart->setAttribute('submitter_id', $new_fks_map[$current_submitter_id]);
            $cart->save();
        }


        $cart_images = Models\CartImage::query()
            ->whereIn('submitter_id', $submitter_ids)
            ->get();
        foreach( $cart_images as $cart_image ) {
            $current_submitter_id = $cart_image->getAttribute('submitter_id');

            $cart_image->setAttribute('submitter_id', $new_fks_map[$current_submitter_id]);
            $cart_image->save();
        }


    }
}
