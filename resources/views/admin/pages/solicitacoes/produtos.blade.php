@extends('admin.layout.admin')
@section('title', 'Solicitações Produtos')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="header_admin_global">
            <button id="new"><i class="fa-solid fa-file"></i> Novo</button>
            <a href="{{ Route('admin') }}">Voltar</a>
        </div>
    </div>
@endsection
@section('modals')
    <div class="d_none_modal" id="kt_modal_solicitacoes_produtos">
        <div class="modal">
            @if ($errors->any())
                <div class="messages_errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="backdrop" id="backdrop">

            </div>
            <div class="modal_active">
                <div class="close">
                    <i id="close" class="fa-solid fa-xmark"></i>
                </div>
                <form action="{{ Route('admin.request.product.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="category" value="request_product">
                    <label for="name_produto">Nome do produto</label>
                    <input class="input_style" type="text" id="name_produto" name="name">
                    <button class="btn" type="submit"><i class="fa-solid fa-arrow-right"></i> Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#new').on('click', function() {
            $('#kt_modal_solicitacoes_produtos').show().slideUp(0).delay(200).fadeIn(1000, function() {
                $('input[type="text"]').focus()
            })
            $('#backdrop').addClass('backdrop')
        })

        $('#close').on('click', function() {
            $('#kt_modal_solicitacoes_produtos').fadeOut(500)
        })

        $('#backdrop').on('click', function() {
            $('#kt_modal_solicitacoes_produtos').fadeOut(500)
        })
    </script>
@endpush
