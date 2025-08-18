<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientMercadoController extends Controller
{
    public function index()
    {
        return view('client.pages.index');
    }

    public function getPage() {}

    public function post() {}
}
