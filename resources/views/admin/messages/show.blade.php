@extends('admin.templates.admin')

@section('title', 'Mensajes') 


@section('content') 

<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Mensaje</h2>
                <p>Mensaje recibido</p>
            </div>

    
            <div class="admin-slider">





<a href="{{ route('admin.messages.index')}}" class="button button-sm">Atrás</a>
<hr>

<div class="col-md-4 col-sm-4 col-xs-4">Asunto: {{$message->subject}}</div> <div class="col-md-8 col-sm-8 col-xs-8 text-right">Fecha: {{$message->created_at->format('d/m/Y')}}</div>
<br>
<hr>
<div class="col-md-6">De: <span class="bold">{{$message->name}}</span><span class="grey"> &lt;{{$message->email}}&gt;</span>
    </div>
<br>
<hr>
<div class="col-md-12">
<h4>Mensaje</h4>

<div class="body-message">
{{$message->message}}
</div>
</div>
</div>

</div>
</div>

</div>
@endsection