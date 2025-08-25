@extends('admin.layout.admin')
@section('title', 'Produtos')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="bloco_action">
            <a href="{{ Route('admin.product.get', 'cadastro_produtos') }}" class="btn"><i class="fa-solid fa-cube"></i> Cadastrar Produto</a>
            <a href="{{ Route('admin.category.get', 'cadastro_categorias') }}" class="btn"><i class="fa-solid fa-layer-group"></i> Cadastrar Categoria</a>
        </div>
        <div>
            @if($products == null)
            @else
                <table id="myTable" class="table-custom">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-fingerprint"></i> ID</th>
                            <th><i class="fa-solid fa-file-signature"></i> Nome</th>
                            <th><i class="fa-solid fa-tag"></i> Preço</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#myTable').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{  Route('admin.datatables.product') }}",
                    "type": "GET"
                },
                "columns": [
                    { "data": "id", name: 'id' },
                    { "data": "name",  name: 'name'  },
                    { "data": "price", name: 'price' },
                ]
            });
        });
    </script>
@endpush
