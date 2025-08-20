<header class="bloco_header">
    <div>
        <i class="fa-brands fa-laravel"></i> {{ auth()->user()->name }}
    </div>
    <form action="{{ Route('admin.logout') }}" method="POST">
        @csrf
        <input type="hidden" name="logout" value="logout">
        <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair</button>
    </form>
</header>
