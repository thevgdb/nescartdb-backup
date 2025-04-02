<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class ProfileController extends Controller
{
    public function cart(Request $request, string|null $cart_id = null, string|null $cart_url_slug = null)
    {
        $cart = Models\Cart::query()
            ->where('cart_id', (string)$cart_id)
            ->first();

        // Ensures that the cart's URL slug segment of the URL is always present and showing in the URL.
        // If for some reason it's blank, then just quickly redirect to the full URL with the slug included.
        if( $cart && is_null($cart_url_slug) ) {
            return redirect( $cart->publicUrl() );
        }

        return view('cart')
            ->with('cart', $cart)
            ->with('page_title', $cart->getAttribute('game_title') . " - NesCartDB");
    }

    public function image(Request $request, string|null $cart_id = null)
    {
        $cart = Models\Cart::query()
            ->where('cart_id', (string)$cart_id)
            ->first();

        if( !$cart ) {
            return redirect()->route('welcome');
        }

        // HTTP GET "position" possible values:
        // cart_top
        // cart_front
        // cart_back
        // pcb_front
        // pcb_back
        // box_front
        // box_back
        // manual

//        $cart_images_array = $cart->getAttribute('images');
//        $img_src = $cart_images_array[ $request->get('position') ]



        $img_src = $cart->imageUrl( $request->get('position') );

        $img_title = str_replace("_", " ", $request->get('position'));
        $img_title = ucwords($img_title);

        return view('image')
            ->with( 'img_src', $img_src )
            ->with( 'img_title', $img_title )
            ->with('page_title', "NesCartDB - Image")
            ;
    }
}
