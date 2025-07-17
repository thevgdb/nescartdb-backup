<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class AppController extends Controller
{
    public function welcome(Request $request)
    {
        $updates_query = Models\Update::query()
            ->where('is_hidden', false);

        $updates = $updates_query
            ->orderBy('posted_at', 'DESC')
            ->get();
        return view('welcome')
            ->with('updates', $updates)
            ->with('page_title', "NESCartDB - Home");
    }

    public function redirectHome(Request $request)
    {
        return redirect()->route('welcome');
    }

    public function search(Request $request)
    {
        return view('search');
    }

    public function about(Request $request)
    {
        return view('about')
            ->with('page_title', "NESCartDB - About");
    }

    public function plugins(Request $request)
    {
        $plugins_query = Models\Plugin::query();

        $plugins = $plugins_query->get();
        return view('plugins')
            ->with('plugins', $plugins)
            ->with('page_title', "NESCartDB - Plugins");
    }

    public function missing(Request $request)
    {
        $missing_carts = Models\MissingCart::orderBy('game_title', 'ASC')->get();

        return view('missing')
            ->with('missing_carts', $missing_carts)
            ->with('page_title', "NESCartDB - Missing Games");
    }

    public function stats(Request $request)
    {
        return view('stats')
            ->with('page_title', "NESCartDB - Stats");
    }
}
