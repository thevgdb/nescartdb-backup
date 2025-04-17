<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class PopulateContributorUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-contributor-users';

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
            ->get();

        foreach( $carts as $cart ) {

            $submitter_username = $cart->getAttribute('submitter');
            if( !strlen($submitter_username) ) {
                $submitter_username = "no_username";
            }
            $submitter_username = str_replace(" ", ".", $submitter_username);

            $user_that_contributed_this_cart_profile = Models\User::query()->where('name', $submitter_username)->get()->last();
            if( !$user_that_contributed_this_cart_profile ) {

                $user_that_contributed_this_cart_profile = new Models\User();
                $user_that_contributed_this_cart_profile->setAttribute('name', $submitter_username);
                $user_that_contributed_this_cart_profile->setAttribute('email', $submitter_username . "@nescartdb-backup.com" );
                $user_that_contributed_this_cart_profile->setAttribute('registered_at', now());
                $user_that_contributed_this_cart_profile->save();

            }

            $cart->submitter()->associate( $user_that_contributed_this_cart_profile );
            $cart->save();

            foreach( $cart->images as $position_key => $current_cart_image_data ) {

                if( is_null($current_cart_image_data) ) {
                    continue;
                }

//                dd($current_cart_image_data);

                $new_cart_image_record = new Models\CartImage();
                $new_cart_image_record->cart()->associate( $cart );

                $ddrivetip_parts = explode("<br>", $current_cart_image_data['ddrivetip']);
                $prefix_to_remove_from_beginning_of_string = 'Submitted by: ';
                $index_in_array_where_this_prefix_occurs = -1;
                foreach( $ddrivetip_parts as $current_index => $ddrivetip_part ) {
                    if(str_starts_with($ddrivetip_part, $prefix_to_remove_from_beginning_of_string)) {
                        $index_in_array_where_this_prefix_occurs = $current_index;
                        break;
                    }
                }

                $cartimage_submitter_user_username = $ddrivetip_parts[$index_in_array_where_this_prefix_occurs];


//                $str = 'Submitted by: bootgod';

                if(substr($cartimage_submitter_user_username, 0, strlen($prefix_to_remove_from_beginning_of_string)) == $prefix_to_remove_from_beginning_of_string) {
                    $cartimage_submitter_user_username = substr($cartimage_submitter_user_username, strlen($prefix_to_remove_from_beginning_of_string));
                }

                if( !strlen($cartimage_submitter_user_username) ) {
                    $cartimage_submitter_user_username = "no_username";
                }
                $cartimage_submitter_user_username = str_replace(" ", ".", $cartimage_submitter_user_username);


                $user_that_contributed_this_cart_image = Models\User::query()->where('name', $cartimage_submitter_user_username)->get()->last();
                if( !$user_that_contributed_this_cart_image ) {
                    $user_that_contributed_this_cart_image = new Models\User();
                    $user_that_contributed_this_cart_image->setAttribute('name', $cartimage_submitter_user_username);
                    $user_that_contributed_this_cart_image->setAttribute('email', $cartimage_submitter_user_username . "@nescartdb-backup.com" );
                    $user_that_contributed_this_cart_image->setAttribute('registered_at', now());
                    $user_that_contributed_this_cart_image->save();
                }

                $new_cart_image_record->submitter()->associate( $user_that_contributed_this_cart_image );

                $new_cart_image_record->setAttribute( 'position', $position_key );
                $new_cart_image_record->setAttribute( 'nescartdb_thumbnail_src', $current_cart_image_data['nescartdb_thumbnail_src'] );
                $new_cart_image_record->setAttribute( 'nescartdb_src', $current_cart_image_data['nescartdb_src'] );
                $new_cart_image_record->save();

            }

        }
    }
}
