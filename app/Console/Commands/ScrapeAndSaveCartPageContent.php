<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;
use App\Models;

class ScrapeAndSaveCartPageContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-and-save-cart-page-content';

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
//        dd( Models\Cart::query()->first()->getAttribute('scraped_page_content') );

        $carts = Models\Cart::query()
            ->where('scraped_page_content', '')
            ->orWhereNull('scraped_page_content')
            ->get();

        $current_count = 0;
        foreach($carts as $cart) {
            $current_count++;
            $nescartdb_external_url = "https://nescartdb.com/profile/view/" . $cart->getAttribute('cart_id') . "/" . $cart->getAttribute('cart_url_slug');
            $this->comment($current_count . "/" . count($carts) . " " . $cart->getAttribute('game_title') . " - " . $nescartdb_external_url);


            $client = Client::createChromeClient();

            $client->request('GET', $nescartdb_external_url);

            $crawler = $client->waitFor('div.content');

//            $cart_scraped_page_content = $crawler->filter('div:has(> div.content)')->html();
//            $cart_scraped_page_content = $crawler->filter('div.content')->html();
            $cart_scraped_page_content = trim($crawler->html());

//            dd( count( explode("\n", $cart_scraped_page_content) ) );

            $html_lines = explode("\n", $cart_scraped_page_content);

            $html_lines = array_slice($html_lines, 181);
            $html_lines = array_values($html_lines); // Re-index the array

            array_splice($html_lines, count($html_lines) - 13, 13);

//            $html_lines = array_slice($html_lines, -13);
//            $html_lines = array_values($html_lines); // Re-index the array



            $cart_scraped_page_content = implode("\n", $html_lines);
            $cart_scraped_page_content = substr($cart_scraped_page_content, 25); // Remove first 25 characters from string to remove the first '<div class="content">' tag from the beginning of the content line in the html.


//            $cart_scraped_page_content = $crawler->filter('div.content')->each(function($div, $i) {
//                return $div->text();
//            });

//            $cart_scraped_page_content = $crawler->filter('div.content')->each(function (Crawler $node, $i) {
//                return $node->html();
//            });

//            print_r($cart_scraped_page_content);
            // Remove first 181 lines
            // Remove first 25 characters from the new current 1st line
            // Remove last 13 lines


            $cart->setAttribute('scraped_page_content', trim($cart_scraped_page_content));
            $cart->save();


//            $this->comment($cart_scraped_page_content);
//            break;

            $seconds_to_sleep = 0.25;
//            sleep($seconds_to_sleep);
            usleep($seconds_to_sleep * 1000000);
        }
    }
}
