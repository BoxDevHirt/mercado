<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class ClientMercadoController extends Controller
{
    public function client()
    {
        $products = Products::all();
        $category = Category::first();
        return view('client.pages.client', compact('products', "category"));
    }

}
