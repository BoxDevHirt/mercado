<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-..." crossorigin="anonymous"></script>
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <title>Mercado | @yield('title')</title>
</head>

<body>
    @include('admin.partials.header')
    <main class="main_content">
        @include('admin.partials.menu')
        @yield('content')
        @yield('modals')
    </main>
</body>
@stack('script')

</html>
