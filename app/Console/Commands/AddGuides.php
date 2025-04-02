<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class AddGuides extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-guides';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private array $guides_data = [
        [
            'identifier_key' => "",
            'title' => "",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "settings",
            'title' => "Configuring the program",
            'menu' => "Menu::Settings::Configure",
            'body_content' => "",
        ],
        [
            'identifier_key' => "test",
            'title' => "Testing CopyNES Communication",
            'menu' => "Menu::CopyNES::Test Connection",
            'body_content' => "",
        ],
        [
            'identifier_key' => "require",
            'title' => "Requirements and Guidelines",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "adding",
            'title' => "Adding a cart to the DB",
            'menu' => "Menu::Datebase::Add Cart",
            'body_content' => "",
        ],
        [
            'identifier_key' => "gameinfo",
            'title' => "Game Information",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "pcb",
            'title' => "PCB Definition",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "img_win",
            'title' => "PCB Scan Viewer",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "props",
            'title' => "Cart Properties",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "chips",
            'title' => "Chip Entry",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "chip_id",
            'title' => "Chip Identification",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "dump",
            'title' => "Dumping the cart",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "update",
            'title' => "Updating a Profile",
            'menu' => "Menu::Database::Update",
            'body_content' => "",
        ],
        [
            'identifier_key' => "conv",
            'title' => "File Format Conversion",
            'menu' => "",
            'body_content' => "",
        ],
        [
            'identifier_key' => "repair",
            'title' => "Header Repair",
            'menu' => "",
            'body_content' => "",
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach( $this->guides_data as $guide_data ) {
            $guide = new Models\Guide();
            $guide->setAttribute('identifier_key', $guide_data['identifier_key']);
            $guide->setAttribute('title', $guide_data['title']);
            $guide->setAttribute('menu', $guide_data['menu']);
            $guide->setAttribute('body_content', $guide_data['body_content']);
            $guide->save();
        }
    }
}
