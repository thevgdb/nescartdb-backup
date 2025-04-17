<?php

namespace Database\Seeders;

use App\Models;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UniqueGamesAndCartProfilesSeeder extends BaseSeeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $unique_games_and_cart_profiles_data = json_decode( Storage::disk('database_backups')->get("seed_data/unique_games_and_cart_profiles.json"), true );

        foreach( $unique_games_and_cart_profiles_data as $current_unique_game_data ) {

            $unique_game = new Models\UniqueGame();
            $unique_game->setAttribute( 'title', (string) $current_unique_game_data['title'] ?? "" );
            $unique_game->save();

        }

    }
}
