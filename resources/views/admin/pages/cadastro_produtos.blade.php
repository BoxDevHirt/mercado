@extends('admin.layout.admin')
@section('title', 'Cadastro Produto')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        @if($category == null)
            <div class="alert-warning">
                Não existe categorias cadastradas
            </div>
        @else
            @if ($errors->any())
                <div class="messages_errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ Route('admin.product.post') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="category_product">
                <label class="label_style" for="product_category_select">Nome do produto</label>
                <select id="product_category_select" class="select_style" name="category_id">
                    <option disabled selected>Selecione....</option>
                    @foreach($category as $records)
                        <option value="{{ $records->id }}" {{ old('category_id') == $records->id ? 'selected' : ''}}>
                            {{ $records->name }}
                        </option>
                    @endforeach
                </select>
                <br/>
                <br/>
                <label class="label_style" for="product_name">Nome do produto</label>
                <input class="input_style" type="text" id="category" name="name" value="{{ old('name') }}" placeholder="Forneça um nome...">
                <br/>
                <br/>
                <label class="label_style" for="product_price">Preço produto</label>
                <input class="input_style" type="text" id="category" name="price" value="{{ old('price') }}" placeholder="Forneça um preço....">
                <br/>
                <button class="btn_submit" type="submit"><i class="fa-solid fa-arrow-up-right-from-square"></i> Cadastrar</button>
            </form>
        @endif
    </div>
@endsection
