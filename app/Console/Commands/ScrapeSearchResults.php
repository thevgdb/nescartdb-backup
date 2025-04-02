<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
use App\Models;
use DateTime;

class ScrapeSearchResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-search-results';

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
        $first_page_number = 1;
        $last_page_number = 92;

        for($current_page_number = $first_page_number; $current_page_number <= $last_page_number; $current_page_number++) {
//            $this->comment($current_page_number);

            $client = Client::createChromeClient();

            $client->request('GET', 'https://nescartdb.com/search/advanced?group=cartid&page=' . $current_page_number);

            $crawler = $client->waitFor('#srtbl');

//            echo $crawler->filter('div:has(> #srtbl)')->text();


            $table = $crawler->filter('div:has(> #srtbl)')->filter('tbody')->filter('tr')->each(function ($tr, $i) {



                $tr_array = $tr->filter('td')->each(function ($td, $i) {

//                    // Region Column
//                    if($i == 1) {
//                        $region_image_src = $td->filter('img')->eq(0)->attr('src');
//
//                        if( $region_image_src == "/img/flag_jap.gif" ) {
//                            return "JAP";
//                        }
//                    }

                    if($i == 1) {
                        $region = "";

                        $region_image_tag = $td->filter('img');
                        if( count($region_image_tag) ) {
                            $region = $region_image_tag->attr('title');
                        }

                        return $region;
                    }

                    if($i == 2) {

                        $cart_id = "";
                        $cart_url_slug = "";
                        $game_title = "";
                        $game_version = "";
                        $game_subtitle = "";

                        $game_title_anchor_tag = $td->filter('a.result');
                        if( count($game_title_anchor_tag) ) {

                            $href_parts = explode("/", $game_title_anchor_tag->attr('href'));
                            $cart_id = $href_parts[3];
                            $cart_url_slug = $href_parts[4];

                            $game_title = $game_title_anchor_tag->text();
                        }

//                        $game_subtitle_span_tag = $td->filter('span.headingsubtitle');
//                        if( count($game_subtitle_span_tag) ) {
//                            $game_subtitle = $game_subtitle_span_tag->text();
//                        }

                        $game_subtitle_span_tag = $td->filter('span.headingsubtitle');
                        if( count($game_subtitle_span_tag) > 0 ) {

                            $td->filter('span.headingsubtitle')->each(function ($span, $i) use (&$game_version, &$game_subtitle) {

                                $span_text = trim( $span->text() );

                                if(  str_starts_with($span_text, "(")  &&  str_ends_with($span_text, ")")  ) {
                                    $game_version = trim($span_text, '()');
                                }
                                else {
                                    $game_subtitle = $span_text;
                                }

                            });

//                            $game_version = "";
//                            $game_subtitle = $game_subtitle_span_tag->text();
                        }

                        return [
                            'cart_id' => trim($cart_id),
                            'cart_url_slug' => trim($cart_url_slug),
                            'game_title' => trim($game_title),
                            'game_version' => trim($game_version),
                            'game_subtitle' => trim($game_subtitle),
                        ];
                    }

                    return trim($td->text());
                });



                $search_result_data_array = [
                    'region' => $tr_array[1],
                    'cart_id' => $tr_array[2]['cart_id'],
                    'cart_url_slug' => $tr_array[2]['cart_url_slug'],
                    'game_title' => $tr_array[2]['game_title'],
                    'game_version' => $tr_array[2]['game_version'],
                    'game_subtitle' => $tr_array[2]['game_subtitle'],
                    'publisher' => $tr_array[3],
                    'catalog_id' => $tr_array[4],
                    'pcb_name' => $tr_array[5],
                    'submitter' => $tr_array[6],
                    'submitted' => $tr_array[7],
                    'number_of_times_cart_verified' => $tr_array[8],
                ];

                return $search_result_data_array;

//                print_r($tr_array);
//                break;
            });

//            print_r($table);
//            break;

            foreach( $table as $search_result_data ) {

                // Don't let entries be added with empty game title strings
                if( strlen($search_result_data['game_title']) == 0 ) {
                    continue;
                }

                $cart = Models\Cart::where('cart_id', $search_result_data['cart_id'])->first();
                if( !$cart ) {
                    $cart = new Models\Cart();
                }

                $cart->setAttribute('region', $search_result_data['region']);
                $cart->setAttribute('cart_id', $search_result_data['cart_id']);
                $cart->setAttribute('cart_url_slug', $search_result_data['cart_url_slug']);
                $cart->setAttribute('game_title', $search_result_data['game_title']);
                $cart->setAttribute('game_version', $search_result_data['game_version']);
                $cart->setAttribute('game_subtitle', $search_result_data['game_subtitle']);
                $cart->setAttribute('publisher', $search_result_data['publisher']);
                $cart->setAttribute('catalog_id', $search_result_data['catalog_id']);
                $cart->setAttribute('pcb_name', $search_result_data['pcb_name']);
                $cart->setAttribute('submitter', $search_result_data['submitter']);
//                $cart->setAttribute('submitted', $search_result_data['submitted']);
                $cart->setAttribute('submitted', DateTime::createFromFormat( 'Y-m-d', $search_result_data['submitted'] ));
                $cart->setAttribute('number_of_times_cart_verified', (int) $search_result_data['number_of_times_cart_verified']);
                $cart->save();

                if( $cart->wasRecentlyCreated ) {
                    $this->info("Created Cart Record: " . $cart->getAttribute('game_title'));
                }
                else {
                    $this->info("Updated Cart Record: " . $cart->getAttribute('game_title'));
                }

            }




            sleep(2);

        }

        return 0;

//        https://nescartdb.com/search/advanced?page=1
//        https://nescartdb.com/search/advanced?page=49

        $client = Client::createChromeClient();
//        // alternatively, create a Firefox client
//        $client = Client::createFirefoxClient();

        $client->request('GET', 'https://nescartdb.com/search/advanced?page=1');
//        $client->clickLink('Getting started');

        // wait for an element to be present in the DOM, even if hidden
        $crawler = $client->waitFor('#srtbl');
//        // you can also wait for an element to be visible
//        $crawler = $client->waitForVisibility('#srtbl');

        // get the text of an element thanks to the query selector syntax
        echo $crawler->filter('div:has(> #srtbl)')->text();


//        // take a screenshot of the current page
//        $client->takeScreenshot('screen.png');
    }
}
