<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminController extends Controller
{
    public function index()
    {
        return View('admin.pages.admin');
    }

    public function getPage() {}

    public function post(Request $request)
    {
        $logout = $request->input('logout');
        if ($logout != null) {
            FacadesAuth::logout();
            return redirect('client');
        }
    }
}
