<nav id="navigation" class="block_navigation">
    <ul id="list_ul">
        <li><a href="{{ Route('admin')  }}"><i class="fa-solid fa-house"></i> Home</a></li>
        <li><a href="{{ Route('admin.product', 'produtos')  }}"><i class="fa-solid fa-cubes"></i> Produtos</a></li>
        <li><a href="#"><i class="fa-solid fa-user-tie"></i> Administradores</a></li>
        <li><a href="{{ Route('client') }}"><i class="fa-solid fa-earth-americas"></i> Web</a></li>
    </ul>
    <div id="close_menu" class="action_menu">
        <i class="fa-solid fa-arrow-up-right-from-square"></i>
    </div>
</nav>
@push('script')
    <script>
        $('#close_menu').on('click', function(){
            $("#navigation").toggleClass("d_none")
            $("#close_menu").toggleClass("d_icon")
            $("#list_ul").toggleClass("d_none_list")
            $(".container").toggleClass("show").slideUp( 0 ).delay( 200 ).fadeIn( 100 )
        })
    </script>
@endpush
