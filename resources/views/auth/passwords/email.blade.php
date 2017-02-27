@extends('admin.templates.principal')


@section('title', 'Email')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="items margin-bottom">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div ><h4 class="text-center">Restaurar contraseña</h4></div>
                <div class="panel-body">
                 @if (session('status'))
                        <div id="resetAlert" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            

                            <div class="col-md-10 col-md-offset-1">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <button type="submit" class="button">
                                    <i class="fa fa-btn fa-envelope"></i> Enviar link de restauración
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection