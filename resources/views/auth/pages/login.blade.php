@extends('auth.layout.login')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="bloco_login_1">
            <img src="{{ asset('assets/client/user.svg') }}" alt="Icone de usuário">
        </div>
        <div class="bloco_login_2">
            @if ($errors->any())
                <div class="messages_errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ Route('login.post') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Coloque seu email" name="email"
                    value="{{ old('email') }}">
                <label for="password">Senha</label>
                <input type="password" id="password" placeholder="Coloque sua senha" name="password"
                    value="{{ old('password') }}">
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>
@endsection
