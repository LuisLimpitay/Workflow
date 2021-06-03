@extends('adminlte::page')

@section('title', 'Inscripciones')

@section('content_header')
    <h1>Ordenes de Compra </h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

    <div class="card">

        <div class="body">

            <table id="example" class="table table-striped">
                <thead class="thead-dark">

                    <th class="text-center">N° Orden</th>
                    <th class="text-center">Clientes</th>
                    <th class="text-center">N° L.N.C.</th>

                    <th class="text-center">Fecha de Inscripcion</th>
                    <th class="text-center">Fecha del Curso</th>

                    <th class="text-center">Metodo de Pago</th>
                    <th class="text-center">Estado del Pago</th>
                    <th>Accion</th>

                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->users->last_name }}, {{ $enrollment->users->name }}</td>
                            <td>{{ $enrollment->users->number_license }}</td>

                            <td class="text-center">{{ \Carbon\Carbon::parse($enrollment->created_at)->format('d/m/Y H:i') }} </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($enrollment->dictations->date)->format('d/m/Y') }}</td>

                            <td class="text-center">{{ $enrollment->payment_method }}</td>
                            @if (dump($enrollment->status == 'aprobado'))
                                <td class="bg-green text-center ">Aprobado</td>
                            @else
                                <td class="bg-red text-center">Pendiernte</td>
                            @endif
                            <td>
                                <button>dd</button>
                                <a href="">cambiar</a>
                            </td>
                            



                            {{-- aca deberia hacer para algo para poder cambiar el estado del pago --}}


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



@stop


@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#example').DataTable({
            responsive: true,
            autoWidth: false
        });

    </script>
@endsection
