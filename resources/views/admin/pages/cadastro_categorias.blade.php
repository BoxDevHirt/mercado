@extends('admin.layout.admin')
@section('title', 'Cadastro Categoria')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        @if ($errors->any())
            <div class="messages_errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ Route('admin.category.post') }}" method="POST">
            @csrf
            <input type="hidden" name="category" value="category_post">
            <label class="label_style" for="categories"><i class="fa-solid fa-file-signature"></i>  Nome da categoria</label>
            <input class="input_style" type="text" id="categories" name="name" placeholder="Forneça uma categoria...">
            <button class="btn_submit" type="submit"><i class="fa-solid fa-arrow-up-right-from-square"></i> Cadastrar</button>
        </form>
    </div>
@endsection