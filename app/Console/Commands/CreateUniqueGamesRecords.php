<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class CreateUniqueGamesRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-unique-games-records';

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

            $unique_game = Models\UniqueGame::query()->where( 'title', $cart->getAttribute('game_title') )->first();
            if( !$unique_game ) {
                $unique_game = new Models\UniqueGame();
                $unique_game->setAttribute('title', $cart->getAttribute('game_title'));
                $unique_game->save();
            }

            $cart->uniqueGame()->associate( $unique_game );
            $cart->save();
        }
    }
}
