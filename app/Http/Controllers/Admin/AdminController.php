<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cadastro_Solicitacao_Produtos as Cadastro_Solicitacao;
use App\Models\Category;
use App\Models\Products;
use App\Models\Solicitacao;
use App\Models\Solicitacao_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return View('admin.pages.admin');
    }

    public function getPage($page)
    {
        $title = null;
        $category = [];
        $products = [];
        $solicitacao_products = [];
        $solicitacao_item = [];

        if ($page == 'produtos') {
            $products = Products::all();
            $title = 'Produtos';
        }

        if ($page == 'cadastro_produtos') {
            $category = Category::all();
            $title = 'Cadastro Produto';
        }

        if ($page == 'cadastro_categorias') {
            $title = 'Categoria Cadastro';
        }

        if ($page == 'solicitacoes-solicitacoes') {
            $solicitacao_products = Cadastro_Solicitacao::all();
            $solicitacao_item = Solicitacao_Item::all();
            $title = 'Solicitações';
        }

        if ($page == 'solicitacoes-produtos') {
            $title = 'Solicitações de produtos';
        }

        $pagesUri = explode('-', $page, -1);
        if ($pagesUri != null) {
            $pages = explode('-', $page, 2);
            return View('admin.pages.' . $pagesUri[0] . '.' . $pages[1], compact('title', 'category', 'products', 'solicitacao_products', 'solicitacao_item', 'solicitacao_item'));
        }

        return View('admin.pages.' . $page, compact('title', 'category', 'products'));
    }

    public function getProductsData()
    {
        $products = Products::select(['id', 'name', 'price']);
        return DataTables::of($products)->make(true);
    }

    public function post(Request $request)
    {
        $post = $request->except('_token');

        /**
         * @Method - Metodo relacionada ao deslogar o usuário
         */
        $logout = $request->input('logout');
        if ($logout != null) {
            Auth::logout();
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

            case 'request_product':
                $validated = $request->validate(
                    [
                        'name' => 'required|string|max:200',
                    ],
                    [
                        'name.required' => 'O nome do produto é obrigatório!',
                        'name.max' => 'O nome precisa ser de até 200 caracteres',
                    ]
                );

                Cadastro_Solicitacao::create($validated);

                return redirect()->back()->with('success', 'Produto cadastrado com sucesso');

            case 'request':
                $solicitacao = $request->validate(
                    [
                        'name' => 'required|string|max:200',
                    ],
                    [
                        'name.required' => 'O nome do produto é obrigatório!',
                        'name.max' => 'O campo nome deve ter no máximo 200 caracter',
                    ]
                );



                $solicitacao_item = $request->validate(
                    [
                        'type_request' => 'required',
                        'quantidade' => 'required|min:1',
                    ],
                    [
                        'type_request.required' => 'O campo selecionar é obrigatório!',
                        'quantidade' => 'O campo quantidade é obrigatório',
                        'quantidade.min' => 'O campo quantidade deve ter no mínimo 1',
                    ]
                );

                $solicitacao_id = Solicitacao::create($solicitacao);
                $date_solicitacao_item = $solicitacao_item;
                $date_solicitacao_item['user_id'] = Auth::id();

                $date_solicitacao_item['solicitacao_id'] = $solicitacao_id->id;
                Solicitacao_Item::create($date_solicitacao_item);

                return redirect()->back()->with('success', 'produto cadastrado com sucesso');

            default:
                return redirect('admin');
        }
    }
}
