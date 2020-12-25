<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\UserOrder;
use Auth;

class ProductsController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id; 
        $products = Product::all();
        //can be extracted to a service
        $pendingOrdersCount = count(UserOrder::where([
            ['user_id', '=', $userId],            
            ['is_fulfilled', '=', false]
        ])->get());
        
        $data = [ 
            'products' => $products,
            'pendingOrdersCount' => $pendingOrdersCount,
        ];

        

        // return $products[0];
        return view('products.index')->with($data);
    }     
}
