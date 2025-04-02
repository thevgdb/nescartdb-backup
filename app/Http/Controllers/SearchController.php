<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        return view('search')
            ->with('page_title', "NesCartDB - Search");
    }

    public function basic(Request $request)
    {
        $carts_query = Models\Cart::query();

        // Keywords:
        if( trim($request->input('keywords')) && strlen(trim($request->input('keywords'))) > 0 ) {
            $kwtype = match( $request->input('kwtype') ) {
                'game', 'pcb', 'chip' => $request->input('kwtype'),
                default => "game",
            };

            if( $kwtype == "game" ) {
                $carts_query->where('game_title', 'LIKE', '%' . trim($request->input('keywords')) . '%')
                    ->orWhere('catalog_id', 'LIKE', '%' . trim($request->input('keywords')) . '%')
                    ;
            }
            else if( $kwtype == "pcb" ) {
                $carts_query->where('pcb_details->PCB Name', 'LIKE', '%' . trim($request->input('keywords')) . '%')
                    ->orWhere('pcb_details->PCB Class', 'LIKE', '%' . trim($request->input('keywords')) . '%')
                    ->orWhere('pcb_details->iNES Mapper', 'LIKE', '%' . trim($request->input('keywords')) . '%')
                    ;
            }
            else if( $kwtype == "chip" ) {
                $carts_query->whereJsonContains('detailed_chip_info->part_number', trim($request->input('keywords')) )
                    ->orWhereJsonContains('detailed_chip_info->type', trim($request->input('keywords')) )
                ;
            }
        }

        $carts = $carts_query
            ->orderBy('game_title', 'ASC')
            ->paginate(50);

        return view('advanced')
            ->with('carts', $carts)
            ->with('page_title', "NesCartDB - Search Results");
    }

    public function advanced(Request $request)
    {
        $carts_query = Models\Cart::query();

        // Title:
        if( trim($request->input('title')) && strlen(trim($request->input('title'))) > 0 ) {
            $title_op = match( $request->input('title_op') ) {
                'contains', 'starts', 'ends', 'not_like', 'any', 'all', 'exact' => $request->input('title_op'),
                default => "contains",
            };

            if( $title_op == "contains" ) {
                $carts_query->where('game_title', 'LIKE', '%' . trim($request->input('title')) . '%');
            }
            else if( $title_op == "starts" ) {
                $carts_query->where('game_title', 'LIKE', trim($request->input('title')) . '%');
            }
            else if( $title_op == "ends" ) {
                $carts_query->where('game_title', 'LIKE', '%' . trim($request->input('title')) );
            }
            else if( $title_op == "not_like" ) {
                $carts_query->where('game_title', 'NOT LIKE', '%' . trim($request->input('title')) . '%');
            }
            else if( $title_op == "any" ) {
                $words = explode( " ", trim($request->input('title')) );
                $carts_query->where(function($query) use ($words) {
                    foreach( $words as $word ) {
                        $query->orWhere('game_title', 'LIKE', '%' . $word . '%');
                    }
                });
            }
            else if( $title_op == "all" ) {
                $words = explode( " ", trim($request->input('title')) );
                $carts_query->where(function($query) use ($words) {
                    foreach( $words as $word ) {
                        $query->where('game_title', 'LIKE', '%' . $word . '%');
                    }
                });
            }
            else if( $title_op == "exact" ) {
                $carts_query->where('game_title', '=', trim($request->input('title')) );
            }
        }

        // Region:
        if( trim($request->input('region')) && strlen(trim($request->input('region'))) > 0 ) {
            $region_op = match ($request->input('region_op')) {
                'equal', 'not_equal' => $request->input('region_op'),
                default => "equal",
            };

            if( $region_op == "equal" ) {
                $carts_query->where('region', '=', trim($request->input('region')) );
            }
            else if( $region_op == "not_equal" ) {
                $carts_query->where('region', '!=', trim($request->input('region')) );
            }
        }

        // Catalog:
        if( trim($request->input('catalog')) && strlen(trim($request->input('catalog'))) > 0 ) {
            $catalog_op = match( $request->input('catalog_op') ) {
                'contains', 'starts', 'ends', 'not_like', 'any', 'all', 'exact' => $request->input('catalog_op'),
                default => "contains",
            };

            if( $catalog_op == "contains" ) {
                $carts_query->where('catalog_id', 'LIKE', '%' . trim($request->input('catalog')) . '%');
            }
            else if( $catalog_op == "starts" ) {
                $carts_query->where('catalog_id', 'LIKE', trim($request->input('catalog')) . '%');
            }
            else if( $catalog_op == "ends" ) {
                $carts_query->where('catalog_id', 'LIKE', '%' . trim($request->input('catalog')) );
            }
            else if( $catalog_op == "not_like" ) {
                $carts_query->where('catalog_id', 'NOT LIKE', '%' . trim($request->input('catalog')) . '%');
            }
            else if( $catalog_op == "any" ) {
                $words = explode( " ", trim($request->input('catalog')) );
                $carts_query->where(function($query) use ($words) {
                    foreach( $words as $word ) {
                        $query->orWhere('catalog_id', 'LIKE', '%' . $word . '%');
                    }
                });
            }
            else if( $catalog_op == "all" ) {
                $words = explode( " ", trim($request->input('catalog')) );
                $carts_query->where(function($query) use ($words) {
                    foreach( $words as $word ) {
                        $query->where('catalog_id', 'LIKE', '%' . $word . '%');
                    }
                });
            }
            else if( $catalog_op == "exact" ) {
                $carts_query->where('catalog_id', '=', trim($request->input('catalog')) );
            }
        }

        // Video System:
        if( trim($request->input('system')) && strlen(trim($request->input('system'))) > 0 ) {
            $system_op = match ($request->input('system_op')) {
                'equal', 'not_equal' => $request->input('system_op'),
                default => "equal",
            };

            if( $system_op == "equal" ) {
                $carts_query->where('cart_details->Video System', '=', trim($request->input('system')) );
            }
            else if( $system_op == "not_equal" ) {
                $carts_query->where('cart_details->Video System', '!=', trim($request->input('system')) );
            }
        }

        // Class (Licensed/Unlicensed):
        if( trim($request->input('class')) && strlen(trim($request->input('class'))) > 0 ) {
            $class_op = match ($request->input('class_op')) {
                'equal', 'not_equal' => $request->input('class_op'),
                default => "equal",
            };

            if( $class_op == "equal" ) {
                $carts_query->where('cart_details->Class', '=', trim($request->input('class')) );
            }
            else if( $class_op == "not_equal" ) {
                $carts_query->where('cart_details->Class', '!=', trim($request->input('class')) );
            }
        }

        // Subclass (3rd-Party/Competition/Multi-cart/Normal/Test Cart/Unreleased):
        if( trim($request->input('subclass')) && strlen(trim($request->input('subclass'))) > 0 ) {
            $subclass_op = match ($request->input('subclass_op')) {
                'equal', 'not_equal' => $request->input('subclass_op'),
                default => "equal",
            };

            if( $subclass_op == "equal" ) {
                // Not sure what to put here.
                // I don't seem to currently have a 'Subclass' field saved locally anywhere.
                // Not sure where that data is shown in the original NesCartDB

                // TODO
            }
            else if( $subclass_op == "not_equal" ) {
                // TODO
            }
        }

        // Publisher:
        if( trim($request->input('publisher')) && strlen(trim($request->input('publisher'))) > 0 ) {
            $publisher_op = match ($request->input('publisher_op')) {
                'equal', 'not_equal' => $request->input('publisher_op'),
                default => "equal",
            };

            if( $publisher_op == "equal" ) {
                $carts_query->where('cart_details->Publisher', '=', trim($request->input('publisher')) );
            }
            else if( $publisher_op == "not_equal" ) {
                $carts_query->where('cart_details->Publisher', '!=', trim($request->input('publisher')) );
            }
        }

        // Developer:
        if( trim($request->input('developer')) && strlen(trim($request->input('developer'))) > 0 ) {
            $developer_op = match ($request->input('developer_op')) {
                'equal', 'not_equal' => $request->input('developer_op'),
                default => "equal",
            };

            if( $developer_op == "equal" ) {
                $carts_query->where('cart_details->Developer', '=', trim($request->input('developer')) );
            }
            else if( $developer_op == "not_equal" ) {
                $carts_query->where('cart_details->Developer', '!=', trim($request->input('developer')) );
            }
        }

        // Porter:
        if( trim($request->input('porter')) && strlen(trim($request->input('porter'))) > 0 ) {
            $porter_op = match ($request->input('porter_op')) {
                'equal', 'not_equal' => $request->input('porter_op'),
                default => "equal",
            };

            if( $porter_op == "equal" ) {
                $carts_query->where('cart_details->Ported by', '=', trim($request->input('porter')) );
            }
            else if( $porter_op == "not_equal" ) {
                $carts_query->where('cart_details->Ported by', '!=', trim($request->input('porter')) );
            }
        }

        // Players:
        if( trim($request->input('players')) && strlen(trim($request->input('players'))) > 0 ) {
            $players_op = match ($request->input('players_op')) {
                'equal' => "=",
                'not_equal' => "!=",
                'more_than' => ">",
                'less_than' => "<",
                'more_than_equ' => ">=",
                'less_than_equ' => "<=",
                default => "=",
            };
            $carts_query->where('cart_details->Players', $players_op, trim($request->input('players')) );
        }



        // Group:
        if( trim($request->input('group')) && strlen(trim($request->input('group'))) > 0 ) {
            if( $request->input('group') == "infoid" ) {
                // TODO
            }
            else if( $request->input('group') == "cartid" ) {
                // TODO
            }
        }




        $carts = $carts_query
            ->orderBy('game_title', 'ASC')
            ->paginate(50);

        return view('advanced')
            ->with('carts', $carts)
            ->with('page_title', "NesCartDB - Search Results");
    }

    public function browse(Request $request, string $letter = null)
    {
        // Invalid letters get redirected back to main search page
        if( !in_array(strtoupper($letter), str_split("@ABCDEFGHIJKLMNOPQRSTUVWXYZ")) ) {
            return redirect()->route('search');
        }


        $carts_query = Models\Cart::query();

        if( $letter == "@" ) {
            $carts_query->where(function($query) {
                $query->where('game_title', 'NOT LIKE', 'A' . '%')
                    ->where('game_title', 'NOT LIKE', 'B' . '%')
                    ->where('game_title', 'NOT LIKE', 'C' . '%')
                    ->where('game_title', 'NOT LIKE', 'D' . '%')
                    ->where('game_title', 'NOT LIKE', 'E' . '%')
                    ->where('game_title', 'NOT LIKE', 'F' . '%')
                    ->where('game_title', 'NOT LIKE', 'G' . '%')
                    ->where('game_title', 'NOT LIKE', 'H' . '%')
                    ->where('game_title', 'NOT LIKE', 'I' . '%')
                    ->where('game_title', 'NOT LIKE', 'J' . '%')
                    ->where('game_title', 'NOT LIKE', 'K' . '%')
                    ->where('game_title', 'NOT LIKE', 'L' . '%')
                    ->where('game_title', 'NOT LIKE', 'M' . '%')
                    ->where('game_title', 'NOT LIKE', 'N' . '%')
                    ->where('game_title', 'NOT LIKE', 'O' . '%')
                    ->where('game_title', 'NOT LIKE', 'P' . '%')
                    ->where('game_title', 'NOT LIKE', 'Q' . '%')
                    ->where('game_title', 'NOT LIKE', 'R' . '%')
                    ->where('game_title', 'NOT LIKE', 'S' . '%')
                    ->where('game_title', 'NOT LIKE', 'T' . '%')
                    ->where('game_title', 'NOT LIKE', 'U' . '%')
                    ->where('game_title', 'NOT LIKE', 'V' . '%')
                    ->where('game_title', 'NOT LIKE', 'W' . '%')
                    ->where('game_title', 'NOT LIKE', 'X' . '%')
                    ->where('game_title', 'NOT LIKE', 'Y' . '%')
                    ->where('game_title', 'NOT LIKE', 'Z' . '%')
                ;
            });
        }
        else {
            $carts_query->where('game_title', 'LIKE', $letter . '%');
        }


        $carts = $carts_query
            ->orderBy('game_title', 'ASC')
            ->paginate(50);


//        $carts = Models\Cart::query()
//            ->where('game_title', 'LIKE', $letter . '%')
//            ->orderBy('game_title', 'ASC')
//            ->paginate(50);

        return view('advanced')
            ->with('carts', $carts)
            ->with('page_title', "NesCartDB - Browse");
    }

    public function random(Request $request)
    {
        $random_cart = Models\Cart::query()->inRandomOrder()->first();

        return redirect()->route('cart', [
            'cart_id' => $random_cart->getAttribute('cart_id'),
            'cart_url_slug' => $random_cart->getAttribute('cart_url_slug'),
        ]);
    }
}
