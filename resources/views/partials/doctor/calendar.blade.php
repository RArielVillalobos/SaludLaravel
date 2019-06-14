@extends('layouts.app')
@section('content')

    <div class="panel panel-default">
                    <div class="panel-heading">Calendario Medico {{auth()->user()->name}} {{auth()->user()->last_name}}</div>
                    <div class="panel-body">
                        {!! $calendar->calendar() !!}

                    </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/es.js"></script>


    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                lang: 'es'
            });
        });
    </script>
    {!! $calendar->script() !!}

@endsection