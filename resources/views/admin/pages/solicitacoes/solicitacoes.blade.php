@extends('admin.layout.admin')
@section('title', 'Solicitações')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div style="margin-bottom: 1rem" class="header_admin_global">
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
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
            @if (!empty($solicitacao_item))
                @foreach ($solicitacao_item as $records)
                    @if ($records->user_id == auth()->id())
                        <div class="card">
                            <div>
                                Solicitante: {{ $records->solicitacao->name }}
                            </div>
                            <div>
                                Item: {{ $records->produtos->name }}
                            </div>
                            <div>
                                Criado por: {{ $records->user->name }} - #{{ $records->user->id }}
                            </div>
                            @if ($records->status == 0)
                                <button class="btn-cancelar text-danger" data-id="{{ $records->id }}">
                                    Cancelar
                                </button>
                            @else
                                <button disabled class="text-cancel" data-id="{{ $records->id }}">
                                    Cancelado
                                </button>
                            @endif
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

        $(document).on("click", ".btn-cancelar", function() {
            let itemId = $(this).data("id");

            // Primeiro, pergunta se quer cancelar
            Swal.fire({
                title: "Tem certeza?",
                text: "Deseja cancelar este item?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, cancelar",
                cancelButtonText: "Não, voltar",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-light"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Só envia AJAX se o usuário confirmar
                    $.ajax({
                        url: "/admin/solicitacoes/cancelar",
                        type: "POST",
                        data: {
                            id: itemId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            let $msg = $('<div></div>')
                                .text(response.message)
                                .css({
                                    padding: "10px",
                                    margin: "10px 0",
                                    width: "300px",
                                    borderRadius: "5px",
                                    backgroundColor: "#d4edda",
                                    color: "#155724",
                                    border: "1px solid #c3e6cb",
                                    textAlign: "center"
                                });

                            $(".container").prepend($msg);
                            $msg.fadeIn(500).delay(5000).fadeOut(500, function() {
                                $(this).remove();
                            });
                        },
                        error: function(xhr) {
                            let $msgErro = $('<div></div>')
                                .text(xhr.responseJSON?.message || "Erro ao cancelar o item")
                                .css({
                                    padding: "10px",
                                    margin: "10px 0",
                                    borderRadius: "5px",
                                    backgroundColor: "#f8d7da",
                                    color: "#721c24",
                                    border: "1px solid #f5c6cb",
                                    textAlign: "center"
                                });

                            $(".container").prepend($msgErro);
                            $msgErro.fadeIn(200).delay(3000).fadeOut(500, function() {
                                $(this).remove();
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
