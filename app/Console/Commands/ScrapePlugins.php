<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
use App\Models;

class ScrapePlugins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-plugins';

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

        $client->request('GET', 'https://nescartdb.com/plugins');

        $crawler = $client->waitFor('.simboxcontent');

        $plugins_table_data = $crawler->filter('div:has(> .simboxcontent)')->filter('tr')->each(function ($trNode, $i) {

            if( $trNode->attr('class') == "odd" || $trNode->attr('class') == "even" ) {

                $current_plugin_row_data = [
                    'filename' => '',
                    'description' => '',
                    'authors' => '',
                    'prg' => '',
                    'chr' => '',
                    'wram' => '',
                    'version' => '',
                    'created' => '',
                    'notes' => '',
                ];

                $td_data_array = $trNode->filter('td')->each(function ($tdNode, $i) use (&$current_plugin_row_data) {

                    if( $i == 0 ) {
                        $current_plugin_row_data['filename'] = trim( $tdNode->text() );
                    }
                    if( $i == 1 ) {
                        $current_plugin_row_data['description'] = trim( $tdNode->text() );
                    }
                    if( $i == 2 ) {
                        $current_plugin_row_data['authors'] = trim( $tdNode->text() );
                    }
                    if( $i == 3 ) {
                        $current_plugin_row_data['prg'] = trim( ( $tdNode->text() != "NA" ? $tdNode->text() : "" ) );
                    }
                    if( $i == 4 ) {
                        $current_plugin_row_data['chr'] = trim( ( $tdNode->text() != "NA" ? $tdNode->text() : "" ) );
                    }
                    if( $i == 5 ) {
                        $current_plugin_row_data['wram'] = trim( ( $tdNode->text() != "NA" ? $tdNode->text() : "" ) );
                    }
                    if( $i == 6 ) {
                        $current_plugin_row_data['version'] = trim( $tdNode->text() );
                    }
                    if( $i == 7 ) {
                        $current_plugin_row_data['created'] = trim( $tdNode->text() );
                    }
                    if( $i == 8 ) {
                        $current_plugin_row_data['notes'] = trim( $tdNode->text() );
                    }

                });


                return $current_plugin_row_data;
            }
            else if( $trNode->attr('class') == "header" ) {
                return [];
            }

        });


//        dd($plugins_table_data);

        foreach( $plugins_table_data as $current_plugin_data ) {

            // Don't let entries be added with empty filenames
            if( !isset($current_plugin_data['filename']) || strlen($current_plugin_data['filename']) == 0 ) {
                continue;
            }

            $plugin = new Models\Plugin();
            $plugin->setAttribute('filename', $current_plugin_data['filename']);
            $plugin->setAttribute('description', $current_plugin_data['description']);
            $plugin->setAttribute('authors', $current_plugin_data['authors']);
            $plugin->setAttribute('prg', $current_plugin_data['prg']);
            $plugin->setAttribute('chr', $current_plugin_data['chr']);
            $plugin->setAttribute('wram', $current_plugin_data['wram']);
            $plugin->setAttribute('version', $current_plugin_data['version']);
//            $plugin->setAttribute('created', $current_plugin_data['created']);
            $plugin->setAttribute( 'created', \DateTime::createFromFormat('Y/m/d', $current_plugin_data['created']) );
            $plugin->setAttribute('notes', $current_plugin_data['notes']);
            $plugin->save();

            $this->info("Created Plugin: " . $plugin->getAttribute('filename'));

        }




    }
}
