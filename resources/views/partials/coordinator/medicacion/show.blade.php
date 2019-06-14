@extends('layouts.app')
@section('estilos')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <table id="medicacion">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>

                </thead>
                <tbody>
                @foreach($medicamentos as $medicamento)
                    <tr>
                        <td>{{$medicamento->id}}</td>
                        <td>{{$medicamento->nombre}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>



@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $('#medicacion').DataTable();
            } );
        });
    </script>



@endsection

