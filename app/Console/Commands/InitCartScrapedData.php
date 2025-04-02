<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;
//use Symfony\Component\Panther\Client;
//use Symfony\Component\Panther\DomCrawler\Crawler;
use Symfony\Component\DomCrawler;
//use Symfony\Component\Panther;

class InitCartScrapedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-cart-scraped-data {cart_id?}';

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
        $carts_query = Models\Cart::query()
            ->where('successfully_initialized_cart_scraped_data', false);

        // If a cart ID is passed as an argument, then retrieve ONLY that cart ID.
        if( !is_null($this->argument('cart_id')) ) {
            $carts_query->where( 'cart_id', $this->argument('cart_id'));
        }

        $carts = $carts_query->get();



        $cart_details_keys = [];
        $cart_properties_keys = [];
        $pcb_details_keys = [];


        $producer_image_filenames = [];


        $current_count = 0;
        foreach($carts as $cart) {
            $current_count++;

            $current_cart_comment_text = (
                    $current_count . "/" . count($carts)) . " "
                . $cart->getAttribute('game_title')
                . " ( " . $cart->publicUrl()
                . " | https://nescartdb.com/profile/view/" . $cart->getAttribute('cart_id') . "/" . $cart->getAttribute('cart_url_slug')
                . " )";
            $this->comment( $current_cart_comment_text );

//            $this->line( $cart->getAttribute('scraped_page_content') );


//            $game_title = "";
//            $game_version = "";
//            $game_subtitle = "";
            $submitted_by = "";
            $submitted_at = "";



            try {

                $crawler = new DomCrawler\Crawler();
                $crawler->addContent( $cart->getAttribute('scraped_page_content') );



                $submitted_by_and_time_submitted_string = $crawler->filter('table')->eq(0)->filter('tr[valign=top] > td.textsmall')->text();
//                $submitted_by_and_time_submitted_string = ltrim($submitted_by_and_time_submitted_string, "»");
//                $submitted_by_and_time_submitted_string = trim($submitted_by_and_time_submitted_string);
                $submitted_by_and_time_submitted_string = substr($submitted_by_and_time_submitted_string, strlen("» Submitted by: "));

//                dd( $submitted_by_and_time_submitted_string );
                $submitted_by_and_time_submitted_parts = explode(" \u{A0}\u{A0}Time: ", $submitted_by_and_time_submitted_string);
//                dd( $submitted_by_and_time_submitted_parts );
                $submitted_by = $submitted_by_and_time_submitted_parts[0];
                $submitted_at = $submitted_by_and_time_submitted_parts[1];


                $relevant_tables = [
                    'cart_details' => null,
                    'cart_properties' => null,
                    'rom_details' => null,
                    'pcb_details' => null,
                    'detailed_chip_info' => null,
                ];

//            $this->line( $crawler->filter('table > tbody > tr.textmain > th')->eq(0)->text() );

                $crawler->filter('table')->each(function ($tableNode, $i) use (&$relevant_tables) {
//                $table_crawler = new DomCrawler\Crawler();
//                $table_crawler->addContent( $tableNode->html() );
//                $this->line( 'Table Index: ' . $i );

                    $thNodes = $tableNode->filter('tbody > tr.textmain > th');
                    if( $thNodes->count() > 0 && $thNodes->eq(0)->text() == "Catalog ID" ) {
                        $relevant_tables['cart_details'] = trim( $tableNode->html() );
                    }

                    $tdNodes = $tableNode->filter('tbody > tr[align=left] > td.headingmain');
                    if( $tdNodes->count() > 0 && $tdNodes->eq(0)->text() == "Cart Properties" ) {
                        $relevant_tables['cart_properties'] = trim( $tableNode->html() );
                    }
                    if( $tdNodes->count() > 0 && $tdNodes->eq(0)->text() == "ROM Details" ) {
                        $relevant_tables['rom_details'] = trim( $tableNode->html() );
                    }
                    if( $tdNodes->count() > 0
                        && $tdNodes->eq(0)->filter('a')->count() > 0
                        && str_starts_with( $tdNodes->eq(0)->filter('a')->eq(0)->attr('href') , "/search/advanced?pcb=" )
                    ) {


                        $relevant_tables['pcb_details'] = trim( $tableNode->html() );
                    }
                    if( $tdNodes->count() > 0 && $tdNodes->eq(0)->text() == "Detailed Chip Info" ) {
                        $relevant_tables['detailed_chip_info'] = trim( $tableNode->html() );
                    }


//                $thNodes = $tableNode->filter('tbody > tr.textmain > th');
//                if( $thNodes->count() > 0 && $thNodes->eq(0)->text() == "PCB Producer" ) {
//                    $relevant_tables['pcb_details'] = trim( $tableNode->html() );
//                }

                });

//            $this->line( $crawler->filter('table')->eq(6)->html() );

//            dd( $relevant_tables );
//            dd( $relevant_tables['pcb_details'] );


                $cart_details = [
                    'Catalog ID' => '',
                    'Region' => '',
                    'Video System' => '',
                    'Class' => '',
                    'Release Date' => '',
                    'Publisher' => '',
                    'Developer' => '',
                    'Players' => '',
                    'Peripherals' => '',
                    'Ported by' => '',
                ];
                $crawler = new DomCrawler\Crawler();
                $crawler->addContent( $relevant_tables['cart_details'] );
                $crawler->filter('tr.textmain')->each(function ($trNode, $i) use (&$cart_details_keys, &$cart_details) {
//                $this->line( $trNode->text() );

                    // Determine the full list of all possible cart details keys in the table in the HTML.
                    $trNode->filter('th')->each(function ($thNodeInside, $j) use (&$cart_details_keys) {
                        $cart_detail_key_found = trim( $thNodeInside->text() );
                        if( !in_array($cart_detail_key_found, $cart_details_keys) ) {
                            $cart_details_keys[] = $cart_detail_key_found;
                        }
                    });



                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Catalog ID" ) {
                        $cart_details['Catalog ID'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Region" ) {
                        $cart_details['Region'] = trim( $trNode->filter('td.textmain img')->eq(0)->attr('title') );

                        $video_system_string = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                        $video_system_string = str_replace("\u{A0}", '', $video_system_string);
                        $video_system_string = trim( str_replace($cart_details['Region'], '', $video_system_string) );
                        $video_system_string = ltrim($video_system_string, "(");
                        $video_system_string = rtrim($video_system_string, ")");
                        $cart_details['Video System'] = $video_system_string;
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Class" ) {
                        $cart_details['Class'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Release Date" ) {
                        $cart_details['Release Date'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Publisher" ) {
                        $cart_details['Publisher'] = trim( $trNode->filter('td.textmain a')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Developer" ) {
                        $cart_details['Developer'] = trim( $trNode->filter('td.textmain a')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Players" ) {
                        $cart_details['Players'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Peripherals" ) {
                        $cart_details['Peripherals'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Ported by" ) {
                        $cart_details['Ported by'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }

                });
                $cart->setAttribute('cart_details', $cart_details);



                $cart_properties = [
                    'Cart Producer' => '',
                    'Color' => '',
                    'Form Factor' => '',
                    'Front Label ID' => '',
                    'Back Label ID / Desc' => '',
                    '2-digit Code' => '',
                    'Embossed Text' => '',
                    'Seal of Quality' => '',
                    'MfgString Present' => '',
                    'Revision' => '',
                    'Secondary ID' => '',
                    'Front Label Desc' => '',
                    'Back Label Desc' => '',
                    'Sequence #' => '',
                    'Back Label ID' => '',
                    '4-digit Code' => '',
                ];
                $crawler = new DomCrawler\Crawler();
                $crawler->addContent( $relevant_tables['cart_properties'] );
                $crawler->filter('tr.textmain')->each(function ($trNode, $i) use (&$cart_properties_keys, &$cart_properties, &$producer_image_filenames) {

                    $trNode->filter('th')->each(function ($thNodeInside, $j) use (&$cart_properties_keys) {
                        $cart_property_key_found = trim( $thNodeInside->text() );
                        if( !in_array($cart_property_key_found, $cart_properties_keys) ) {
                            $cart_properties_keys[] = $cart_property_key_found;
                        }
                    });


                    try {

                        if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Cart Producer" ) {

                            if( $trNode->filter('td.textmain img')->count() > 0 ) {
                                // The "Cart Producer" column is an image
                                // Get the Cart Producer name from the image title, and get the image filename as well.
                                $cart_producer_text = trim( $trNode->filter('td.textmain img')->eq(0)->attr('title') );

                                // Check and see if this producer image hasn't already been found.
                                $producer_image_filename = $trNode->filter('td.textmain img')->eq(0)->attr('src');
                                $producer_image_filename = str_replace("/img/", "", $producer_image_filename);
                                if (!in_array($producer_image_filename, $producer_image_filenames)) {
                                    $producer_image_filenames[] = $producer_image_filename;
                                }
                            }
                            else {
                                // The "PCB Producer" column is not an image - it is just plain text.
//                            $pcb_details['PCB Producer'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                                $cart_producer_text = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                            }

                            // To prevent possible duplicate entries of the 'PCB Producer' key,
                            // check first to see if this value has already been set -- if it has already been set, then don't set it again.
                            if( is_null($cart_properties['Cart Producer'])
                                || (is_string($cart_properties['Cart Producer']) && strlen($cart_properties['Cart Producer']) == 0)
                            ) {
                                $cart_properties['Cart Producer'] = $cart_producer_text;
                            }

                        }

                    }
                    catch(\InvalidArgumentException $ex) {
                        $this->error('EXCEPTION!');
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Color" ) {
                        $cart_properties['Color'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Form Factor" ) {
                        $cart_properties['Form Factor'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Front Label ID" ) {
                        $cart_properties['Front Label ID'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Back Label ID / Desc" ) {
                        $cart_properties['Back Label ID / Desc'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "2-digit Code" ) {
                        $cart_properties['2-digit Code'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Embossed Text" ) {
                        $cart_properties['Embossed Text'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Seal of Quality" ) {
                        $cart_properties['Seal of Quality'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "MfgString Present" ) {
                        $cart_properties['MfgString Present'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Revision" ) {
                        $cart_properties['Revision'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Secondary ID" ) {
                        $cart_properties['Secondary ID'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Front Label Desc" ) {
                        $cart_properties['Front Label Desc'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Back Label Desc" ) {
                        $cart_properties['Back Label Desc'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Sequence #" ) {
                        $cart_properties['Sequence #'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Back Label ID" ) {
                        $cart_properties['Back Label ID'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "4-digit Code" ) {
                        $cart_properties['4-digit Code'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                    }

                });
                $cart->setAttribute('cart_properties', $cart_properties);



                $rom_details = [];
                $crawler = new DomCrawler\Crawler();
                $crawler->addContent( $relevant_tables['rom_details'] );
                $crawler->filter('tr.textmain:not([align=left])')->each(function ($trNode, $i) use (&$rom_details) {

//                if( $trNode->filter('td')->count() > 0 && $trNode->filter('td')->eq(0)->text() == "4-digit Code" ) {
//                    $cart_properties['4-digit Code'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
//                }

                    $type_column_index = 0;
                    $label_column_index = 1;
                    $size_column_index = 2;
                    $crc32_column_index = 3;
                    $number_of_verifications_column_index = 4;

                    $type_value = trim( $trNode->filter('td')->eq(0)->text() );

                    if( $trNode->filter('td')->eq(0)->attr('colspan') == "2" ) {
                        $size_column_index = 1;
                        $crc32_column_index = 2;
                        $number_of_verifications_column_index = 3;

                        $label_value = "";
                    }
                    else {
                        $label_value = trim( $trNode->filter('td')->eq(1)->text() );
                        $label_value = str_replace("&nbsp;", "", $label_value);
                        $label_value = str_replace("\u{A0}", "", $label_value);
                    }

                    $size_value = trim( $trNode->filter('td')->eq( $size_column_index )->text() );

                    $crc32_value = trim( $trNode->filter('td')->eq( $crc32_column_index )->text() );

                    $sha1_value = trim( $trNode->filter('td')->eq( $crc32_column_index )->attr('title') );
                    $sha1_value = str_replace("SHA-1:", "", $sha1_value);

                    $number_of_verifications_value = trim( $trNode->filter('td')->eq( $number_of_verifications_column_index )->text() );

                    $rom_details[] = [
                        'type' => trim( $type_value ),
                        'label' => trim( $label_value ),
                        'size' => trim( $size_value ),
                        'crc32' => trim( $crc32_value ),
                        'sha1' => trim( $sha1_value ),
                        'number_of_verifications' => trim( $number_of_verifications_value ),

                    ];

                });
                $cart->setAttribute('rom_details', $rom_details);




                $pcb_details = [
                    'PCB Name' => '',
                    'PCB Producer' => '',
                    'Manufacturer' => '',
                    'Mfg Range' => '',
                    'Est First Run' => '',
                    'PCB Class' => '',
                    'iNES Mapper' => '',
                    'Mirroring' => '',
                    'Battery present' => '',
                    'WRAM' => '',
                    'VRAM' => '',
                    'CIC Type' => '',
                    'Hardware' => '',
                ];
                $crawler = new DomCrawler\Crawler();
                $crawler->addContent( $relevant_tables['pcb_details'] );
                $pcb_details['PCB Name'] = trim( $crawler->filter('tr[align=left] > td.headingmain > a')->text() );
                $crawler->filter('tr.textmain')->each(function ($trNode, $i) use (&$pcb_details_keys, &$pcb_details, &$producer_image_filenames, &$relevant_tables) {

                    $trNode->filter('th')->each(function ($thNodeInside, $j) use (&$pcb_details_keys) {
                        $pcb_details_key_found = trim($thNodeInside->text());
                        if (!in_array($pcb_details_key_found, $pcb_details_keys)) {
                            $pcb_details_keys[] = $pcb_details_key_found;
                        }
                    });


                    try {

                        if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "PCB Producer" ) {

//                        $pcb_producer_text = "";

                            if( $trNode->filter('td.textmain img')->count() > 0 ) {
                                // The "PCB Producer" column is an image
                                // Get the PCB Producer name from the image title, and get the image filename as well.
                                $pcb_producer_text = trim( $trNode->filter('td.textmain img')->eq(0)->attr('title') );

                                // Check and see if this producer image hasn't already been found.
                                $producer_image_filename = $trNode->filter('td.textmain img')->eq(0)->attr('src');
                                $producer_image_filename = str_replace("/img/", "", $producer_image_filename);
                                if (!in_array($producer_image_filename, $producer_image_filenames)) {
                                    $producer_image_filenames[] = $producer_image_filename;
                                }
                            }
                            else {
                                // The "PCB Producer" column is not an image - it is just plain text.
//                            $pcb_details['PCB Producer'] = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                                $pcb_producer_text = trim( $trNode->filter('td.textmain')->eq(0)->text() );
                            }


                            // To prevent possible duplicate entries of the 'PCB Producer' key,
                            // check first to see if this value has already been set -- if it has already been set, then don't set it again.
                            if( is_null($pcb_details['PCB Producer'])
                                || (is_string($pcb_details['PCB Producer']) && strlen($pcb_details['PCB Producer']) == 0)
                            ) {
                                $pcb_details['PCB Producer'] = $pcb_producer_text;
                            }

                        }

                    }
                    catch(\InvalidArgumentException $ex) {
//                    dd("EXCEPTION!" . get_class($ex));
//                    $this->comment( $current_cart_comment_text );
//                    dd($relevant_tables['pcb_details']);
                        $this->error('EXCEPTION!');
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Manufacturer" ) {
                        $pcb_details['Manufacturer'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Mfg Range" ) {
                        $pcb_details['Mfg Range'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Est First Run" ) {
                        $pcb_details['Est First Run'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "PCB Class" ) {
                        $pcb_details['PCB Class'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "iNES Mapper" ) {
                        $pcb_details['iNES Mapper'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Mirroring" ) {
                        $pcb_details['Mirroring'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Battery present" ) {
                        $pcb_details['Battery present'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "WRAM" ) {
                        $pcb_details['WRAM'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "VRAM" ) {
                        $pcb_details['VRAM'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "CIC Type" ) {
                        $pcb_details['CIC Type'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }
                    if( $trNode->filter('th')->count() > 0 && $trNode->filter('th')->eq(0)->text() == "Hardware" ) {
                        $pcb_details['Hardware'] = trim( $trNode->filter('td.textmain, td.textna')->eq(0)->text() );
                    }

                });
                $cart->setAttribute('pcb_details', $pcb_details);










                if( !is_null($relevant_tables['detailed_chip_info']) ) {

                    $detailed_chip_info = [];
                    $crawler = new DomCrawler\Crawler();
                    $crawler->addContent( $relevant_tables['detailed_chip_info'] );
                    $crawler->filter('tr.textmain:not([align=left])')->each(function ($trNode, $i) use (&$detailed_chip_info) {

//                $label_value = trim( $trNode->filter('td')->eq(1)->text() );
//                $label_value = str_replace("&nbsp;", "", $label_value);
//
//                $sha1_value = trim( $trNode->filter('td')->eq(3)->attr('title') );
//                $sha1_value = str_replace("SHA-1:", "", $sha1_value);

                        $part_number = trim( $this->extractCurrentText($trNode->filter('td')->eq(2)) );
                        $part_number = str_replace("&nbsp;", "", $part_number);
                        $part_number = str_replace("\u{A0}", "", $part_number);
                        $part_number_subdetail = "";
//                if( $trNode->filter('td')->eq(2)->filter('span.subdetail')->count() > 0 ) {
//                    $part_number_subdetail = trim( $trNode->filter('td')->eq(2)->filter('span.subdetail')->eq(0)->text() );
//
//                    // Also remember to remove the subdetail from the end of the current part number
//                    $part_number = substr($part_number, 0, (-1 * strlen($part_number_subdetail)) );
//                }
                        $trNode->filter('td')->eq(2)->filter('span.subdetail')->each(function($spanNode, $i) use (&$part_number_subdetail) {
                            $part_number_subdetail .= ($spanNode->text() . " ");
                        });

                        $type = trim( $this->extractCurrentText($trNode->filter('td')->eq(3)) );
                        $type = str_replace("&nbsp;", "", $type);
                        $type = str_replace("\u{A0}", "", $type);
                        $type_subdetail = "";
//                if( $trNode->filter('td')->eq(3)->filter('span.subdetail')->count() > 0 ) {
//                    $type_subdetail = trim( $trNode->filter('td')->eq(3)->filter('span.subdetail')->eq(0)->text() );
//                }
                        $trNode->filter('td')->eq(3)->filter('span.subdetail')->each(function($spanNode, $i) use (&$type_subdetail) {
                            $type_subdetail .= ($spanNode->text() . " ");
                        });




                        $detailed_chip_info[] = [
                            'designation' => trim( $trNode->filter('td')->eq(0)->text() ),
                            'maker' => trim( $trNode->filter('td')->eq(1)->text() ),
                            'part_number' => trim( $part_number ),
                            'part_number_subdetail' => trim( $part_number_subdetail ),
                            'type' => trim( $type ),
                            'type_subdetail' => trim( $type_subdetail ),
                            'package' => trim( $trNode->filter('td')->eq(4)->text() ),
                            'datecode' => trim( $trNode->filter('td')->eq(5)->filter('span')->eq(0)->text() ),
                            'datecode_subdetail' => trim( $this->extractCurrentText( $trNode->filter('td')->eq(5) ) ),
                            'datecode_standardized' => trim( $trNode->filter('td')->eq(7)->text() ),
                            'misc' => trim( $trNode->filter('td')->eq(8)->text() ),
                        ];

                    });
                    $cart->setAttribute('detailed_chip_info', $detailed_chip_info);

                }


                $cart->setAttribute('submitter', $submitted_by);
                $cart->setAttribute('submitted', $submitted_at);

//            dd( $cart->getAttribute('cart_details') );
//            dd( $cart->getAttribute('cart_properties') );
//            dd( $cart->getAttribute('rom_details') );
//            dd( $cart->getAttribute('pcb_details') );
//            dd( $cart->getAttribute('detailed_chip_info') );


                $cart->save();

                $cart->setAttribute('successfully_initialized_cart_scraped_data', true);
                $cart->save();

                $this->info( "✅ Successfully saved!");
            }
            catch(\InvalidArgumentException|\TypeError|\Error|\Exception $ex) {
                $this->error( "❌ ERROR OCCURRED! InvalidArgumentException " . $ex->getFile() . ":" . $ex->getLine() . " - " . $ex->getMessage() );
                $this->line( $ex->getTraceAsString() );
            }
//            break;


        }


//        $this->line(" ");
//        $this->line(  "Cart Details Keys: " . implode( ",", $cart_details_keys) );
//        $this->line(  "Cart Properties Keys: " . implode( ",", $cart_properties_keys) );
//        $this->line(  "PCB Details Keys: " . implode( ",", $pcb_details_keys) );
//
//        $this->line(" ");
//        $this->line(  "Producer Image Filenames: " . implode( " | ", $producer_image_filenames) );
//        $this->line(" ");

    }


    /**
     * Extract the current text from a Crawler node, which EXCLUDES text in any children nodes.
     *
     * @param DomCrawler\Crawler $crawler
     * @return mixed
     */
    private function extractCurrentText(DomCrawler\Crawler $crawler)
    {
        $clone = new DomCrawler\Crawler();
        $clone->addHTMLContent("<body><div>" . $crawler->html() . "</div></body>", "UTF-8");
        $clone->filter("div")->children()->each(function(DomCrawler\Crawler $child) {
            $node = $child->getNode(0);
            $node->parentNode->removeChild($node);
        });
        return $clone->text();
    }
}
