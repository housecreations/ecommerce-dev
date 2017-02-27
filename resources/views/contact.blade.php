@extends('admin.templates.principal')


@section('title', 'Contáctanos')
@section('js-top')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="container contact-section">
<div class="items">    

 <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>

   
    <li class="active">Contacto</li>
  <hr>
</ol>

<div class="col-md-12">
    
    <h2>Información de contacto</h2>
    <p>Estas son las formas en las que puedes contactarnos, elige la mejor para ti.</p>
    
      <ul>
           
           <li>Teléfonos: +58 414 865 27 77 </li>
           <li>Correo: contacto@exoticas.com.ve</li>
        
           
           
            </ul>
    <hr>
</div>


<div class="col-md-8 col-sm-12 col-xs-12">

<h2>Formulario de contacto</h2>

{!! Form::open(['route' => 'messages.store', 'id' => 'message_form', 'method' => 'POST']) !!}

<div class="form-group col-md-12 col-sm-12 col-xs-12">

{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre y apellido', 'id' => 'form-name']) !!}
</div>

<div class="form-group col-md-12 col-sm-12 col-xs-12">

{!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Correo electrónico']) !!}
</div>




<div class="form-group col-md-12 col-sm-12 col-xs-12">

{!! Form::text('subject', null, ['class' => 'form-control', 'required', 'placeholder' => 'Asunto']) !!}
</div>



<div class="form-group col-md-12 col-sm-12 col-xs-12">

{!! Form::textarea('body', null, ['class' => 'form-control', 'size' => '20x5', 'required', 'placeholder' => 'Escriba su mensaje']) !!}
</div>



<div class="col-md-12 col-sm- col-xs-12 recap">
<div class="form-group">
   
   <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
    
    {{--{!! Form::submit('Enviar mensaje', ['class' => 'button button-lg top-margin'])!!}--}}
    <button type="submit" class="button button-lg top-margin">Enviar mensaje</button>
</div>
</div>
{!! Form::close() !!}

    </div>
   
</div>
</div>
@endsection