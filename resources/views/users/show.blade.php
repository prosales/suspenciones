@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Eliminar Usuario
                    
                </div>
                <div class="panel-body">
                    
                    {!! Form::open(['route' => ['users.destroy', $registro->id], 'method' => 'DELETE', 'class' => 'form-horizontal'])  !!}
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <h4>¿Está seguro de eliminar el registro?</h4>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                <a href="{{ route('users.index') }}" type="submit" class="btn btn-default">Cerrar</a>
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('ul.menu').find('li.active').removeClass('active');
        $('ul.menu').find('li.users').addClass('active');
    });
</script>
@endpush