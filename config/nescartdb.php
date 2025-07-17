<?php

return [

    'database_schema' => [

    ],

    'user_authentication_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | SQL Database Tables Prefix
    |--------------------------------------------------------------------------
    |
    | This is a prefix that is prepended to all tables stored in the SQL
    | database (which is what stores all the data contained in this backup).
    | You can optionally add a prefix to help keep the database tables
    | more organized, which might be a good idea if that's something you
    | may want to do. Completely optional, no worries if you don't!
    |
    */

    'database_tables_prefix' => "nescartdb__",



    'database' => [
        "connection" => "sqlite",

        "sqlite" => [

        ],

        "mysql" => [

        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | Latest Dumps
    |--------------------------------------------------------------------------
    |
    | This is the number of latest dumps to be shown in the app layout, which
    | appears on the right hand side navigation area on any page in the app
    | Change this number to any suitable integer number that you want!
    |
    */

    'num_latest_dumps_to_show' => env('NESCARTDB_NUM_LATEST_DUMPS_TO_SHOW', 10),



    'show_backup_info_on_cart_profile_page' => true,




    /*
    |--------------------------------------------------------------------------
    | Original NES Cart Database Source URL
    |--------------------------------------------------------------------------
    |
    | This is the URL of the (working) existing NesCartDB URL where backups
    | will be made from.
    |
    */

    'original_url' => "https://nescartdb.com/",

];
