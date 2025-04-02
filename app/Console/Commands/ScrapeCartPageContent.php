<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;
use App\Models;

class ScrapeCartPageContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-cart-page-content';

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
            ->where('scraped_page_content', '')
            ->orWhereNull('scraped_page_content')
            ->get();

        foreach($carts as $cart) {
            $nescartdb_external_url = "https://nescartdb.com/profile/view/" . $cart->getAttribute('cart_id') . "/" . $cart->getAttribute('cart_url_slug');
            $this->comment($cart->getAttribute('game_title') . " - " . $nescartdb_external_url);


            $client = Client::createChromeClient();

            $client->request('GET', $nescartdb_external_url);

            $crawler = $client->waitFor('div.content');



//            $images = [
//                "Cart Front" => null,
//                "Cart Back" => null,
//                "Cart Top" => null,
//                "PCB Front" => null,
//                "PCB Back" => null,
//                "Box Front" => null,
//                "Box Back" => null,
//                "Manual" => null,
//            ];

//            $cart_front_image = null;
//            $cart_back_image = null;
//            $cart_top_image = null;
//            $pcb_front_image = null;
//            $pcb_back_image = null;
//            $box_front_image = null;
//            $box_back_image = null;
//            $manual = null;

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
                ],
            ];




            //            $cart_scraped_page_content = $crawler->filter('div:has(> div.content)')->html();
            $crawler->filter('body:has(> .content)')->filter('a.myimg')->each(function ($myImgElement, $i) use (&$cart_page_attributes) {

                $href_attribute = trim($myImgElement->attr('href'));

                $ddrivetip_text = $myImgElement->attr('onmouseover');
                $ddrivetip_text = substr($ddrivetip_text, strlen("ddrivetip('"));
                $ddrivetip_text = substr($ddrivetip_text, 0, -2); // Removes the trailing "')"


                $image_array_key = null;
                $image_array_value = [
                    'ddrivetip' => $ddrivetip_text,
                    'nescartdb_thumbnail_src' => "https://nescartdb.com" . $myImgElement->filter('img')->attr('src'),
                    'nescartdb_src' => '',
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

                $cart_page_attributes['images'][$image_array_key] = $image_array_value;


//                return trim($myImgElement->attr('href'));
            });

//            dd($cart_page_attributes);

            $cart->setAttribute('images', $cart_page_attributes['images']);
            $cart->save();



            sleep(1);
        }
    }
}
