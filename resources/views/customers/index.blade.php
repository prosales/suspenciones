@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Clientes
                        <a href="{{ route('customers.create') }}" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> Crear cliente</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="records-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Nombre Comercial</th>
                                    <th>Razón Social</th>
                                    <th>Dirección</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        $(document).ready(function() {
            alertify.set('notifier','position', 'top-right');
            $('ul.menu').find('li.active').removeClass('active');
            $('ul.menu').find('li.customers').addClass('active');

            var table = $('#records-table').DataTable({
                language: {
                    url: 'lang/datatables-spanish.json'
                },
                processing: true,
                serverSide: true,
                ajax: 'customers.data',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'trade_name', name: 'trade_name'},
                    {data: 'business_name', name: 'business_name'},
                    {data: 'address', name: 'address'},
                    {data: 'status', name: 'status', searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        @if(Session::has('success'))
            alertify.success("{{ Session::get('success') }}");
        @endif
    </script>
    @endpush
@endsection
