<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
use App\Models;

class ScrapeMissingCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-missing-carts';

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
        $client = Client::createChromeClient();

        $client->request('GET', 'https://nescartdb.com/missing');

        $crawler = $client->waitFor('#srtbl');

        $missing_carts_table_data = $crawler->filter('div:has(> #srtbl)')->filter('tbody')->filter('tr')->each(function ($tr, $i) {

            $tr_array = $tr->filter('td')->each(function ($td, $i) {

                if($i == 1) {
                    $region = "";

                    $region_image_tag = $td->filter('img');
                    if( count($region_image_tag) ) {
                        $region = $region_image_tag->attr('title');
                    }

                    return $region;
                }

                if($i == 3) {
                    $game_title = "";
                    $game_subtitle = "";

                    $game_title_span_tag = $td->filter('span.nolink');
                    if( count($game_title_span_tag) ) {
                        $game_title = $game_title_span_tag->text();
                    }

                    $game_subtitle_span_tag = $td->filter('span.headingsubtitle');
                    if( count($game_subtitle_span_tag) ) {
                        $game_subtitle = $game_subtitle_span_tag->text();
                    }

                    return [
                        'game_title' => trim($game_title),
                        'game_subtitle' => trim($game_subtitle),
                    ];
                }

                return trim($td->text());
            });

            $missing_cart_data_array = [
                'region' => $tr_array[1],
                'catalog_id' => $tr_array[2],
                'game_title' => $tr_array[3]['game_title'],
                'game_subtitle' => $tr_array[3]['game_subtitle'],
                'released' => $tr_array[4],
                'publisher' => $tr_array[5],
                'system' => $tr_array[6],
                'class' => $tr_array[7],
            ];

            return $missing_cart_data_array;


        });


        foreach( $missing_carts_table_data as $current_missing_cart_data ) {

            // Don't let entries be added with empty game title strings
            if( strlen($current_missing_cart_data['game_title']) == 0 ) {
                continue;
            }

            $missing_cart = new Models\MissingCart();
            $missing_cart->setAttribute('region', $current_missing_cart_data['region']);
            $missing_cart->setAttribute('catalog_id', $current_missing_cart_data['catalog_id']);
            $missing_cart->setAttribute('game_title', $current_missing_cart_data['game_title']);
            $missing_cart->setAttribute('game_subtitle', $current_missing_cart_data['game_subtitle']);
            $missing_cart->setAttribute('released', $current_missing_cart_data['released']);
            $missing_cart->setAttribute('publisher', $current_missing_cart_data['publisher']);
            $missing_cart->setAttribute('system', $current_missing_cart_data['system']);
            $missing_cart->setAttribute('class', $current_missing_cart_data['class']);
            $missing_cart->save();

            $this->info("Created Missing Cart Record: " . $missing_cart->getAttribute('game_title'));

        }




    }
}
