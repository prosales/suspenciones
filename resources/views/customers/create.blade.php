@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Cliente
                    
                </div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('customers.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Código</label>
                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>
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
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >
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
                                <input id="trade_name" type="text" class="form-control" name="trade_name" value="{{ old('trade_name') }}" required >
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
                                <input id="business_name" type="text" class="form-control" name="business_name" value="{{ old('business_name') }}" required>
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
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                                <a href="{!! route('customers.index') !!}" type="submit" class="btn btn-default">Cerrar</a>
                            </div>
                        </div>
                    </form>

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