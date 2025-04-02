<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class ResetScrapedPageContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-scraped-page-content';

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
            $cart->setAttribute('scraped_page_content', "");
            $cart->save();
        }

    }
}
