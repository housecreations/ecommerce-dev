@extends('admin.templates.principal')


@section('title', 'Registro de usuario')

@section('content')
  <div class="container">
    <div class="items">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div><h4 class="text-center">Registro de usuario</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.auth.register') }}">
                        {{ csrf_field() }}
                        
                        <div class="col-md-3"></div>
                         <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           

                           
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                        
                        
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                           

                            
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus placeholder="Apellido">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                           
                        </div>
                        

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           

                          
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Correo electrónico">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                       

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            

                          
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                       

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                           

                          
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme la contraseña">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        

                        <div class="form-group">
                            
                                <button type="submit" class="cart-button">
                                    Registrar
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