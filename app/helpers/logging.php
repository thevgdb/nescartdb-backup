<?php

use Illuminate\Support\Facades\Log;

if( !function_exists('nescartdb_log') ) {
    function nescartdb_log(string $message = ""): bool
    {
        logger()->channel('nescartdb')->info( now() . " - " . (strlen($message) > 0 ? $message : "No Logger Message Provided") );

//        Log::channel('nescartdb')->info( now() . " - " . $message );
        return true;
    }
}
