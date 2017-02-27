@extends('admin.templates.admin')

@section('title', 'Mensajes') 


@section('content') 

<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Mensajes</h2>
                <p>Administre los mensajes recibidos en su aplicación</p>
            </div>

    
            <div class="admin-slider">

    <a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>


<hr>

@if(sizeof($messages) == 0)

<h4 class='text-center'>No hay mensajes para mostrar</h4>

@else
<table class='table table-hover'>
   <thead>
    <th>Correo</th>
    <th>Asunto</th>
    <th>Fecha</th>
    <th>Acciones</th>
</thead>
<tbody>
@foreach($messages as $message)



@if($message->read == 'no')
<tr class="unread" data-href="{{route('admin.messages.show', $message->id)}}">
@else

<tr data-href="{{route('admin.messages.show', $message->id)}}">
@endif



<td>{{$message->email}}</td>
<td>{{$message->subject}}</td>
<td>{{$message->created_at->diffForHumans()}}</td>
<td><a href="{{route('admin.messages.destroy', $message->id)}}" class="button">Eliminar</a></td>

    </div>

</tr>




@endforeach
</tbody>
</table>
@endif
</div>
<div class="text-center">
    {{$messages->render()}}
</div>

</div>
</div>

@endsection

@section('js')
<script>
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
    </script>
@endsection

