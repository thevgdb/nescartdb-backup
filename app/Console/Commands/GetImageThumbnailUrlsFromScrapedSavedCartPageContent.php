<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
//use Symfony\Component\Panther\DomCrawler\Crawler as PantherCrawler;
use Symfony\Component\DomCrawler\Crawler;
use App\Models;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Panther\Exception\InvalidArgumentException;
use DateTime;

class GetImageThumbnailUrlsFromScrapedSavedCartPageContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-image-thumbnail-urls-from-scraped-saved-cart-page-content {cart_id?}';

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
//        $duration_start = new DateTime();
        $timestamp_start = time();



        $carts_query = Models\Cart::query()
            ->where('all_images_saved_locally', false)
            ->where('errors_occurred_when_saving_images_locally', false);

        // If a cart ID is passed as an argument, then retrieve ONLY that cart ID.
        if( !is_null($this->argument('cart_id')) ) {
            $carts_query->where( 'cart_id', $this->argument('cart_id'));
        }

        $carts = $carts_query->get();

        $current_count = 0;
        foreach($carts as $cart) {
            $current_count++;

//            $nescartdb_external_url = "https://nescartdb.com/profile/view/" . $cart->getAttribute('cart_id') . "/" . $cart->getAttribute('cart_url_slug');
//            $this->comment($cart->getAttribute('game_title') . " - " . $nescartdb_external_url);



            $this->line("");


//            $current_cart_comment_text = ($current_count . "/" . count($carts)) . " " . $cart->getAttribute('game_title');
//            $this->comment( $current_cart_comment_text );


            str_repeat("=", (int) exec("tput cols") );

            $cart_title = $cart->getAttribute('game_title');
            $counter_title = (string)($current_count . "/" . count($carts));

//            str_repeat(" ", ((int) exec("tput cols")   -  (strlen($cart_title) + strlen($counter_title))  ) );


            $this->comment( $cart_title . str_repeat(" ", ((int) exec("tput cols")   -  (strlen($cart_title) + strlen($counter_title))  ) ) . $counter_title );
            $this->comment( "Local URL: " . $cart->publicUrl() . " | " . "Original URL: " . $cart->originalUrl() );
//            $this->comment( "Original URL: https://nescartdb.com/profile/view/" . $cart->getAttribute('cart_id') . "/" . $cart->getAttribute('cart_url_slug') );

            $total_number_of_seconds_passed = (time() - $timestamp_start);
            $hours_passed = floor($total_number_of_seconds_passed / 3600);
            $minutes_passed = floor(($total_number_of_seconds_passed % 3600) / 60);
            $seconds_passed = $total_number_of_seconds_passed % 60;
            $time_passed_string = "";
            if($hours_passed > 0) {
                $time_passed_string .= $hours_passed . " hour" . ($hours_passed != 1 ? 's' : '') . ", ";
            }
            if($minutes_passed > 0) {
                $time_passed_string .= $minutes_passed . " minute" . ($minutes_passed != 1 ? 's' : '') . ", ";
            }
            $time_passed_string .= $seconds_passed . " second" . ($seconds_passed != 1 ? 's' : '');
            $time_passed_string .= " ( " . $total_number_of_seconds_passed . " total second(s) )";
            $this->comment( "Time Passed: " . $time_passed_string );


            $this->comment( str_repeat("=", (int) exec("tput cols") ) );


//            $client = Client::createChromeClient();
//
//            $client->request('GET', $nescartdb_external_url);
//
//            $crawler = $client->waitFor('div.content');

            $crawler = new Crawler( $cart->getAttribute('scraped_page_content') );
//            $crawler->addHtmlContent( $cart->getAttribute('scraped_page_content') );


            $cart_page_attributes = [
                'images' => [
                    'cart_front' => null,
                    'cart_back' => null,
                    'cart_top' => null,
                    'pcb_front' => null,
                    'pcb_back' => null,
                    'box_front' => null,
                    'box_back' => null,
                    'manual' => null,
                    'insert' => null,
                ],
            ];

            try {
                //            $cart_scraped_page_content = $crawler->filter('div:has(> div.content)')->html();
                $crawler->filter('a.myimg')->each(function ($myImgElement, $i) use (&$cart_page_attributes) {

                    $href_attribute = trim($myImgElement->attr('href'));

                    $ddrivetip_text = $myImgElement->attr('onmouseover');
                    $ddrivetip_text = substr($ddrivetip_text, strlen("ddrivetip('"));
                    $ddrivetip_text = substr($ddrivetip_text, 0, -2); // Removes the trailing "')"


                    $image_array_key = null;
                    $image_array_value = [
                        'ddrivetip' => $ddrivetip_text,
                        'nescartdb_thumbnail_src' => "https://nescartdb.com" . $myImgElement->filter('img')->attr('src'),
//                    'nescartdb_src' => '',
                    ];

                    if( str_contains($href_attribute, "position=cart_top") ) {
                        $image_array_key = "cart_top";
                    }
                    else if( str_contains($href_attribute, "position=cart_front") ) {
                        $image_array_key = "cart_front";
                    }
                    else if( str_contains($href_attribute, "position=cart_back") ) {
                        $image_array_key = "cart_back";
                    }
                    else if( str_contains($href_attribute, "position=pcb_front") ) {
                        $image_array_key = "pcb_front";
                    }
                    else if( str_contains($href_attribute, "position=pcb_back") ) {
                        $image_array_key = "pcb_back";
                    }
                    else if( str_contains($href_attribute, "position=box_front") ) {
                        $image_array_key = "box_front";
                    }
                    else if( str_contains($href_attribute, "position=box_back") ) {
                        $image_array_key = "box_back";
                    }
                    else if( str_contains($href_attribute, "position=manual") ) {
                        $image_array_key = "manual";
                    }
                    else if( str_contains($href_attribute, "position=insert") ) {
                        $image_array_key = "insert";
                    }

                    $cart_page_attributes['images'][$image_array_key] = $image_array_value;


//                return trim($myImgElement->attr('href'));
                });

//            break;


//            dd($cart_page_attributes);



                // Now perform an additional HTTP request to determine the URL of the large, non-thumbnail version
                // of each image that is determined to exist (based on the presence of the thumbnail image existing).
                // We must perform a separate HTTP request to determine what the direct URL is of each full size image.
                foreach( $cart_page_attributes['images'] as $image_position_key => $cart_page_image ) {

                    if( is_null($cart_page_image) ) {
                        continue;
                    }


                    $nescartdb_full_size_image_page_external_url = "https://nescartdb.com/profile/image/" . $cart->getAttribute('cart_id') . "?position=" . $image_position_key;
                    $this->comment("\t • " . $cart->getAttribute('game_title') . " - " . $nescartdb_full_size_image_page_external_url);


                    $client = Client::createChromeClient();
                    $client->request('GET', $nescartdb_full_size_image_page_external_url);

                    $crawler = $client->waitFor('div.content');

                    $full_size_nescartdb_image_direct_url = "https://nescartdb.com" . $crawler->filter('div.content')->filter('img')->attr('src');

                    $cart_page_attributes['images'][$image_position_key]['nescartdb_src'] = $full_size_nescartdb_image_direct_url;


                    // Sleep for a bit to avoid sending too many requests too fast to the external server.
                    // We're not trying to DDOS them.
                    $this->sleepForABit(0.1);
                }




                // Save images data locally.  But this is just information about the images.
                // After this we still need to save a copy of each of the images themselves locally as well.
                $cart->setAttribute('images', $cart_page_attributes['images']);
                $cart->save();





                foreach( $cart_page_attributes['images'] as $image_position_key => $cart_page_image ) {
                    if( is_null($cart_page_image) ) {
                        continue;
                    }


//                $url = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
//                $contents = file_get_contents($url);
//                $name = substr($url, strrpos($url, '/') + 1);
//                Storage::put($name, $contents);


                    // Get the contents of the file from the external URL
                    $nescartdb_image_thumbnail_contents = file_get_contents($cart_page_attributes['images'][$image_position_key]['nescartdb_thumbnail_src']);
                    // Generate a new filename for the thumbnail
                    $thumbnail_filename = $cart->getAttribute('cart_id') . '_' . $image_position_key . '_thumbnail.jpg';
                    // Save the file to the storage directory
                    Storage::disk('public')->put('cart_images/' . $thumbnail_filename, $nescartdb_image_thumbnail_contents);


                    // Now do the same thing as above to save the full size image as well.
                    $nescartdb_image_contents = file_get_contents($cart_page_attributes['images'][$image_position_key]['nescartdb_src']);
                    $full_size_image_filename = $cart->getAttribute('cart_id') . '_' . $image_position_key . '.jpg';
                    Storage::disk('public')->put('cart_images/' . $full_size_image_filename, $nescartdb_image_contents);






                    $this->sleepForABit(0.1);
                }


                $cart->setAttribute('backed_up_at', now());
                $cart->setAttribute('all_images_saved_locally', true);
            }
            catch(InvalidArgumentException $ex) {
                $this->error('Errors Occurred!');
                $cart->setAttribute('errors_occurred_when_saving_images_locally', true);
            }

            $cart->save();








//            dd($cart_page_attributes);

//            break;


//            $this->sleepForABit(0.25);
        }

    }

    private function sleepForABit(int|float $seconds_to_sleep = 0.5): void
    {
//            sleep($seconds_to_sleep);
        usleep($seconds_to_sleep * 1000000);
    }
}
