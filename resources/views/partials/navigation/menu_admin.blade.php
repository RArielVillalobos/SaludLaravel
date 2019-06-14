<div class="panel panel-primary">
    <div class="panel-heading">Menu {{auth()->user()->role->name}}</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            @if(auth()->check())
                {{-- AGREGANDO CLASES CON LARAVEL(SI LA RUTA ES HOME AGREGAR LA CLASE ACTIVE )  --}}
                <li @if (request()->is('home')) class="active" @endif><a href="/home">Home</a></li>
                <ul class="nav nav-pills">

                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Pacientes <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="/pacientes">Pacientes Activos</a></li>
                            <li><a href="/pacientes/provisorios">Pacientes Provisorios</a></li>
                            <li><a href="/pacientes/alta">Pacientes de Alta</a></li>
                            <li><a href="/pacientes/noingresados">Pacientes No Ingresados</a></li>
                            <li><a href="/pacientes/epicrisis">Pacientes Con Epicrisis Generada</a></li>

                            {{-- <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a>--}}
                            <li><a href="/cargar">Cargar Pacientes</a></li>

                        </ul>
                    </li>

                </ul>


                <li @if(request()->is('activarepisodio')) class="active" @endif><a href="/activarepisodio">Activar Episodios</a></li>

                {{-- @if(!auth()->user()->is_client)--}}

               {{-- <li @if (request()->is('cargar')) class="active" @endif><a   aria-hidden="true" href="/cargar"> Cargar Paciente</a></li> --}}
            @endif

            {{--<li @if (request()->is('prestadores')) class="active" @endif><a href="/prestadores">Listado de Prestadores</a></li> --}}

            {{--<li @if(request()->is('citas')) class="active" @endif><a href="/citas"> Generar Citas</a></li> --}}


           {{--  @if(auth()->user()->is_admin) --}}
                <ul class="nav nav-pills">

                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Diagramas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="/diagramamedico">Diagrama Médico</a></li>
                            <li><a href="/diagramaenfermeria">Diagrama Enfermeria</a></li>
                            <li><a href="/diagramakinesiologia">Diagrama Kinesiologia</a></li>
                            <li><a href="/diagramapsicologia">Diagrama Psicologia</a></li>
                            <li><a href="/diagramaasistentesocial">Diagrama Asistente Social</a></li>

                            {{-- <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a>--}}

                        </ul>
                    </li>

                </ul>
            <ul class="nav nav-pills">

                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Administracion <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">

                        {{--<li><a href="/cronomedico">Cronograma Medico</a></li> --}}

                        <li><a href="/prestadores">Prestadores</a></li>
                        <li><a href="obrasocial/alta">Obras Social</a></li>
                        {{--<li><a href="/ingresosmedicos">Ingresos Médicos</a></li> --}}


                        {{-- <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a>--}}
                        {{-- <li><a>Cama Virtual</a></li>--}}
                        {{--<li><a href="/config">Configuracion</a></li> --}}

                    </ul>
                </li>

            </ul>


                {{-- <ul class="nav nav-pills">

                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Farmacia <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">


                            <li><a href="/cargarmedicacion">Cargar Medicacion al Sistema</a></li>
                             <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a>

                        </ul>
                    </li>

                </ul>--}}


                <ul class="nav nav-pills">

                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Prorrogas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="/asignarprorroga">Asignar Prorroga</a></li>

                            {{-- <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a>--}}
                            <li><a href="/prorrogas">Prorrogas</a></li>

                        </ul>
                    </li>

                </ul>
            {{-- @endif--}}

            {{--@else
                <li><a href="#">Benvenido</a></li>
                <li><a href="#">Instrucciones</a></li>
                <li><a href="#">Creditos</a></li>



            @endif --}}

        </ul>
    </div>

</div>



{{-- <a href="/pacientes">Pacientes Activos</a>
<a href="/prestadores">Listado Prestadores</a>
<a href="/citas">Generar Citas</a>
<a href="/cronomedico">Cronograma Medico</a>--}}
