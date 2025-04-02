<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models;

class ConvertSqliteDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-sqlite-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private array $data = [
        [
            'table' => 'carts',
            'model' => Models\Cart::class,
            'columns' => [
                'cart_id' => 'string',
                'cart_url_slug' => 'string',
                'game_title' => 'string',
                'game_version' => 'string',
                'game_subtitle' => 'string',
                'region' => 'string',
                'publisher' => 'string',
                'catalog_id' => 'string',
                'pcb_name' => 'string',
                'submitter' => 'string',
                'submitted' => 'datetime',
                'backed_up_at' => 'datetime',
                'number_of_times_cart_verified' => 'string',
                'images' => 'json',
                'cart_details' => 'json',
                'cart_properties' => 'json',
                'rom_details' => 'json',
                'pcb_details' => 'json',
                'detailed_chip_info' => 'json',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
            ],
        ],
        [
            'table' => 'missing_carts',
            'model' => Models\MissingCart::class,
            'columns' => [
                'region' => 'string',
                'catalog_id' => 'string',
                'game_title' => 'string',
                'game_subtitle' => 'string',
                'released' => 'string',
                'publisher' => 'string',
                'system' => 'string',
                'class' => 'string',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
            ],
        ],
        [
            'table' => 'plugins',
            'model' => Models\Plugin::class,
            'columns' => [
                'filename' => 'string',
                'description' => 'string',
                'authors' => 'string',
                'prg' => 'string',
                'chr' => 'string',
                'wram' => 'string',
                'version' => 'string',
                'created' => 'date',
                'notes' => 'string',
                'is_hidden' => 'boolean',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
            ],
        ],
        [
            'table' => 'updates',
            'model' => Models\Update::class,
            'columns' => [
                'title' => 'string',
                'posted_at' => 'datetime',
                'posted_by' => 'string',
                'body_content' => 'string',
                'is_hidden' => 'boolean',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
            ],
        ],
        [
            'table' => 'guides',
            'model' => Models\Guide::class,
            'columns' => [
                'identifier_key' => 'string',
                'title' => 'string',
                'menu' => 'string',
                'body_content' => 'string',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
            ],
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach( $this->data as $current_data ) {
//            dd( $current_data );
            $this->line("Current Table: " . $current_data['table']);
            $created_count = 0;

            $old_table_data = DB::connection('sqlite_old')->table( $current_data['table'] )->get();
            foreach( $old_table_data as $old_table_data_row ) {
                $old_table_data_row = (array)$old_table_data_row;

//                dd( $old_table_data_row );
//                dd( $current_data['columns'] );

                $new_model = (new ($current_data['model'])());
                foreach( $current_data['columns'] as $current_data_column_key => $current_data_column_cast_as )
                {
                    $attribute_value = $old_table_data_row[$current_data_column_key];

                    if( $current_data_column_cast_as == "string" ) {
                        //
                    }
                    else if( $current_data_column_cast_as == "datetime" ) {
                        //
                    }
                    else if( $current_data_column_cast_as == "boolean" ) {
                        $attribute_value = filter_var( $attribute_value , FILTER_VALIDATE_BOOL );
                    }
                    else if( $current_data_column_cast_as == "json" ) {
                        $attribute_value = json_decode($attribute_value, true);
                    }

//                    if( in_array($current_data_column_key, $current_data['json_columns']) ) {
//                        $attribute_value = json_decode($attribute_value, true);
//                    }

                    $new_model->setAttribute($current_data_column_key, $attribute_value);
                }
                $new_model->save();
                $created_count++;
            }

            $this->line("Created " . $created_count . " records");
        }

    }
}
