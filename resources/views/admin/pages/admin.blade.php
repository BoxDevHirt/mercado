@extends('admin.layout.admin')
@section('title', 'Administrativo')
@section('content')
    <div class="container">
        <form action="{{ Route('admin.logout') }}" method="POST">
            @csrf
            <input type="hidden" name="logout" value="logout">
            <button type="submit">Sair</button>
        </form>
    </div>
@endsection
