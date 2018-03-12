@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Usuario
                    
                </div>
                <div class="panel-body">
                    
                    {!! Form::open(['route' => ['customers.update', $registro->id], 'method' => 'PUT', 'class' => 'form-horizontal'])  !!}
                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Código</label>
                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ $registro->code }}" required autofocus>
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre Cliente</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $registro->name }}" required >
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('trade_name') ? ' has-error' : '' }}">
                            <label for="trade_name" class="col-md-4 control-label">Nombre Comercial</label>
                            <div class="col-md-6">
                                <input id="trade_name" type="text" class="form-control" name="trade_name" value="{{ $registro->trade_name }}" required >
                                @if ($errors->has('trade_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('trade_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                            <label for="business_name" class="col-md-4 control-label">Razón Social</label>
                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control" name="business_name" value="{{ $registro->business_name }}" required>
                                @if ($errors->has('business_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('business_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Dirección</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ $registro->address }}" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Estado</label>
                            <div class="col-md-6">
                                <select id="status" class="form-control" name="status">
                                    @if($registro->status == 1)
                                        <option value="1" selected>Activo</option>
                                        <option value="0">Suspendido</option>
                                    @else
                                        <option value="1">Activo</option>
                                        <option value="0" selected>Suspendido</option>
                                    @endif
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <a href="{{ route('customers.index') }}" type="submit" class="btn btn-default">Cerrar</a>
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
        $('ul.menu').find('li.customers').addClass('active');
    });
</script>
@endpush