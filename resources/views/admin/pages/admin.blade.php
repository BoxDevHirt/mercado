@extends('admin.layout.admin')
@section('title', 'Administrativo')
@section('content')
  <div class="container">
      @if (session('success'))
          <div style="margin-top: 1rem;" class="message-success">
              {{ session('success') }}
          </div>
      @endif
  </div>
@endsection
