<div class="panel panel-primary">
    <div class="panel-heading">Menu {{auth()->user()->role->name}}</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            @if(auth()->check())
                {{-- AGREGANDO CLASES CON LARAVEL(SI LA RUTA ES HOME AGREGAR LA CLASE ACTIVE )  --}}
                {{-- <li @if (request()->is('home')) class="active" @endif><a  class="fa fa-home" aria-hidden="true" href="/home"> Dashboard</a></li>--}}
                {{--<li @if(request()->is('camavirtual')) class="active" @endif><a class="fa fa-bed" aria-hidden="true" href="/camavirtual"> Camas Virtual</a></li> --}}

               {{--  <li @if (request()->is('calendariovisitasmedicas')) class="active" @endif><a class="fa fa-calendar-plus" aria-hidden="true" href="/calendariovisitasmedicas"> Calendario Visitas Médicas</a></li>--}}
                {{-- @if(!auth()->user()->is_client)--}}
                <li @if (request()->is('cronogramamedico')) class="active" @endif><a  class="fa fa-calendar-plus" aria-hidden="true" href="/cronogramamedico"> Calendario Médico</a></li>
                <li @if(request()->is('asignados'))class="active" @endif><a href="/asignados">Pacientes a Cargo</a></li>
            @endif

                {{-- <li @if (request()->is('cargar')) class="active" @endif><a  class="fa fa-database" aria-hidden="true" href="/cargar"> Cargar Paciente</a></li>--}}



               {{--
                @if(auth()->user()->is_admin) --}}
                {{--
                    <ul class="nav nav-pills">

                        <li role="presentation" class="dropdown">
                            <a class="fa fa-users dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                Administracion <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">

                                <li><a href="/cargarmedicacion">Cargar Medicacion al Sistema</a></li>
                                <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a></li>
                                <li><a href="/config">Configuracion</a></li>
                            </ul>
                        </li>

                    </ul>--}}
                {{-- @endif--}}

            {{--@else
                <li><a href="#">Benvenido</a></li>
                <li><a href="#">Instrucciones</a></li>
                <li><a href="#">Creditos</a></li>



            @endif --}}

        </ul>
    </div>

</div>
