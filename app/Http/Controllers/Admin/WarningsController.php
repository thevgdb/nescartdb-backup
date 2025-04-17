<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models;

class WarningsController extends BaseController
{
    public function showWarningsPage(Request $request)
    {
        $warnings = [];

        $carts_with_no_cart_front_image = [];
        $carts = Models\Cart::query()
            ->get();
        foreach( $carts as $cart ) {
            if( !$cart->hasImage('cart_front') ) {
                $carts_with_no_cart_front_image[] = $cart;
            }
        }

        if( count($carts_with_no_cart_front_image) > 0 ) {
            $carts_with_no_front_image_warning_body_html = "<p>The following " . count($carts_with_no_cart_front_image) . " cart profiles have no front image:</p>";
            $carts_with_no_front_image_warning_body_html .= "<ol>";
            foreach( $carts_with_no_cart_front_image as $cart_with_no_cart_front_image ) {
                $carts_with_no_front_image_warning_body_html .= '<li><a href="' . $cart_with_no_cart_front_image->publicUrl() . '">' . $cart_with_no_cart_front_image->publicUrl() . '</a></li>';
            }
            $carts_with_no_front_image_warning_body_html .= "</ol>";

            $warnings[] = $carts_with_no_front_image_warning_body_html;
        }

        return view('admin.warnings')
            ->with('warnings', $warnings)
            ->with('page_title', "NesCartDB Admin - Warnings");
    }
}
