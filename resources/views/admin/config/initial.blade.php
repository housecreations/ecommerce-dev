@extends('admin.templates.admin')

@section('title', 'Configuración inicial')


@section('content')

    <div class="container">

        <div class='admin-container'>

            <div class="col-md-12 col-xs-12">
                <div class="col-md-8 col-md-offset-2">
                    <div class="admin-breadcrumb">
                        <h2>Configuración inicial</h2>
                        <p>Gestione el funcionamiento de la aplicación</p>
                    </div>


                    <div class="admin-slider">
                        <div class="col-md-8 col-md-offset-2">
                            {!! Form::open(['route' => 'admin.configuration.store', 'method' => 'POST']) !!}

                            <h2>Información de la página</h2>
                            <hr>

                            <div class="form-group">
                                {!! Form::label('page_title', 'Título de la página') !!}
                                {!! Form::text('page_title', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('currency', 'Moneda') !!}
                                {!! Form::select('currency', ['Bs' => 'Bolívares', '$' => 'Dólares Americanos'],null, ['id'=>'currencyCmb','class' => 'form-control', 'required', 'placeholder' => 'Seleccione una moneda']) !!}
                            </div>
                            {!! Form::hidden('currency_code', null, ['id' => 'currencyCodeCmb']) !!}
                            <div class="form-group">
                                {!! Form::label('sender_email', 'Email para el envío de correos electrónicos') !!}
                                {!! Form::text('sender_email', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('receiver_email', 'Email para la recepción de correos electrónicos') !!}
                                {!! Form::text('receiver_email', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender', 'Géneros para la clasificación de artículos') !!}
                                {!! Form::select('gender', ['female' => 'Damas', 'male' => 'Caballeros', 'both' => 'Damas y Caballeros', 'no-gender' => 'Sin genero'],null, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', 'Dirección') !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone_number', 'Teléfono') !!}
                                {!! Form::number('phone_number', null, ['class' => 'form-control']) !!}
                            </div>

                            <h2>Redes sociales</h2>
                            <hr>

                            <div class="form-group">
                                {!! Form::label('twitter_user', 'Usuario de Twitter ') !!}
                                {!! Form::text('twitter_user', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('instagram_user', 'Usuario de Instagram') !!}
                                {!! Form::text('instagram_user', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('facebook_user', 'Usuario de Facebook') !!}
                                {!! Form::text('facebook_user', null, ['class' => 'form-control']) !!}
                            </div>


                            <div class="form-group text-center">

                                {!! Form::submit('Guardar cambios', ['class' => 'cart-button button-sm'])!!}

                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection