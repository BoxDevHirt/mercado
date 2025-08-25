@extends('admin.layout.admin')
@section('title', 'Solicitações')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="header_admin_global">
            <button id="new"><i class="fa-solid fa-file"></i> Novo</button>
            <a href="{{ Route('admin') }}">Voltar</a>
        </div>
        @if ($errors->any())
            <div class="messages_errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div style="display: flex; gap: 1rem">
            @if (!empty($solicitacao_item))
                @foreach ($solicitacao_item as $records)
                    @if ($records->user_id == auth()->id())
                        <div>
                            Solicitante: {{ $records->solicitacao->name }}<br /><br />
                            Item: {{ $records->produtos->name }}<br /><br />
                            Criado por: {{ $records->user->name }}
                        </div>
                    @endif
                @endforeach
            @else
                <div class="messages_errors">Não tem produtos cadastrados</div>
            @endif
        </div>
    </div>
@endsection
@section('modals')
    <div class="d_none_modal" id="kt_modal_solicitacoes">
        <div class="modal">
            <div class="backdrop" id="backdrop">

            </div>
            <div class="modal_active">
                <div class="close">
                    <i id="close" class="fa-solid fa-xmark"></i>
                </div>
                <form action="{{ Route('admin.request.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="category" value="request">
                    <label for="name">Nome solicitante</label>
                    <input class="input_style" type="text" id="quantity" name="name">
                    <br />
                    <br />
                    <label for="type_request">Qual o produto</label>
                    <select class="input_style" name="type_request">
                        <option value="" selected>Selecione...</option>
                        @foreach ($solicitacao_products as $records)
                            <option value="{{ $records->id }}">{{ $records->name }}</option>
                        @endforeach
                    </select>
                    <br />
                    <br />
                    <label for="quantidade">Quantidade</label>
                    <input class="input_style" type="text" id="quantidade" name="quantidade">
                    <button class="btn" type="submit"><i class="fa-solid fa-arrow-right"></i> Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#new').on('click', function() {
            $('#kt_modal_solicitacoes').show().slideUp(0).delay(200).fadeIn(1000, function() {
                $('input[name="name"]').focus()
            })
            $('#backdrop').addClass('backdrop')
        })

        $('#close').on('click', function() {
            $('#kt_modal_solicitacoes').fadeOut(500)
        })

        $('#backdrop').on('click', function() {
            $('#kt_modal_solicitacoes').fadeOut(500)
        })
    </script>
@endpush
