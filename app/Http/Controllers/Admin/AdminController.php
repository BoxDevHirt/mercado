<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminController extends Controller
{
    public function index()
    {
        return View('admin.pages.admin');
    }

    public function getPage($page) {

        $title = null;
        $category = [];
        $products = [];

        if($page == 'produtos') {
            $products = Products::all();
            $title = 'Produtos';
        }

        if($page == 'cadastro_produtos') {
            $category = Category::all();
            $title = 'Cadastro Produto';
        }

        if($page == 'cadastro_categorias') {
            $title = 'Categoria Cadastro';
        }

        return View('admin.pages.'.$page, compact('title', 'category', 'products'));
    }

    public function post(Request $request)
    {
        $post = $request->except('_token');
        /**
         * @Method - Metodo relacionada ao deslogar o usuário
         */
        $logout = $request->input('logout');
        if ($logout != null) {
            FacadesAuth::logout();
            return redirect('client');
        }

        /**
         * @Switch - Metodo relacionada ao cadastro de produtos
         */
        switch ($post['category']) {
            case 'category_post':
                $validated = $request->validate(
                    [
                        'name' => 'required|string',
                    ],
                    [
                        'name.required' => 'O nome da categoria é obrigatorio!',
                    ]
                );

                Category::create($validated);

                return redirect('admin')->with('success', 'Categoria cadastrada com sucesso!');
            case 'category_product':
                $validated = $request->validate(
                    [
                        'name' => 'required|string',
                        'price' => 'required',
                        "category_id" => "required|exists:category,id",
                    ],
                    [
                        'name.required' => 'O nome do produto é obrigatório!',
                        'price.required' => 'O preço do produto é obrigatório!',
                        'category_id.required' => 'Selecione uma categoria para o produto!',
                    ]
                );

                Products::create($validated);

                return redirect('admin')->with('success', 'Produto cadastrada com sucesso!');
            default:
                return redirect('admin');
        }
    }
}
