@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i> Crear usuario</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="records-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
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
            $('ul.menu').find('li.users').addClass('active');

            var table = $('#records-table').DataTable({
                language: {
                    url: 'lang/datatables-spanish.json'
                },
                processing: true,
                serverSide: true,
                ajax: 'users.data',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status', searchable: false},
                    {data: 'role', name: 'role', searchable: false},
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
