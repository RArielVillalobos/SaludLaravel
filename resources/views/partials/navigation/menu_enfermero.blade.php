


<div class="panel panel-primary">
    <div class="panel-heading">Menu {{auth()->user()->role->name}}</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            @if(auth()->check())
                {{-- AGREGANDO CLASES CON LARAVEL(SI LA RUTA ES HOME AGREGAR LA CLASE ACTIVE )  --}}
                <li @if (request()->is('home')) class="active" @endif><a href="/home">Dashboard</a></li>
                {{-- @if(!auth()->user()->is_client)--}}
                <li @if (request()->is('cronogramaenfermeria')) class="active" @endif><a href="/cronogramaenfermeria">Calendario {{auth()->user()->name }} {{auth()->user()->last_name}}</a></li>
            @endif



            {{--
             @if(auth()->user()->is_admin) --}}


            {{-- @endif--}}

            {{--@else
                <li><a href="#">Benvenido</a></li>
                <li><a href="#">Instrucciones</a></li>
                <li><a href="#">Creditos</a></li>



            @endif --}}

        </ul>
    </div>

</div>