@extends('client.layout.client')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="bloco_category">
            <h1>{{ $category->name }}</h1>
        </div>
        <div class="bloco_table">
            @if($products == null)
            @else
                <table class="table-custom">
                    <tbody>
                    @foreach($products as $records)
                        <tr>
                            <td>{{ $records->id }}</td>
                            <td>{{ $records->name }}</td>
                            <td>R$ {{ $records->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
