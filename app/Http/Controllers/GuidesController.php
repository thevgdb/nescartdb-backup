<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class GuidesController extends Controller
{
    public function guides(Request $request)
    {
        return view('guides')
            ->with('page_title', "NesCartDB - Manual: Index");
    }

    public function view(Request $request, string $guide_key)
    {
        $guide = Models\Guide::query()
            ->where('identifier_key', $guide_key)
            ->first();

        if( !$guide ) {
            abort( 404, "Guide can not be found." );
        }

        return view('guide')
            ->with('guide', $guide)
            ->with('page_title', "NesCartDB - Manual: " . $guide->getAttribute('title'));
    }
}
