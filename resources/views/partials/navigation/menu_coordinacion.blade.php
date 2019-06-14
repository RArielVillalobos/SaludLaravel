<div class="panel panel-primary">
    <div class="panel-heading">Menu {{auth()->user()->role->name}}</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            @if(auth()->check())

                <ul class="nav nav-pills">

                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Farmacia <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="/indicacionesmedicas">Indicaciones Medicas</a></li>
                            {{--<li><a href="/diagramaenfermeria">Cargar Medicacion</a></li> --}}

                            <li><a href="/medicacion">Medicación</a></li>


                            {{-- <li><a href="/cargartratamiento">Cargar Tratamiento al Sistema</a>--}}

                        </ul>
                    </li>

                </ul>

                <li @if (request()->is('evoluciones')) class="active" @endif><a href="/evoluciones">Evoluciones</a></li>


            @endif

        </ul>
    </div>

</div>

