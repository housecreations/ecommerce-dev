@extends('admin.templates.admin')


@section('title', 'Lista de plantillas')


@section('content')

    <div class="container">

        <div class='admin-container'>

            <div class="col-md-12 col-xs-12">

                <div class="admin-breadcrumb">
                    <h2>Plantillas</h2>
                    <p>Cree, edite o elimine plantillas para artículos</p>
                </div>


                <div class="admin-slider">
                    <a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>

                    <a data-toggle="modal" data-target="#addTemplate" class="button button-sm pull-right">Nueva plantilla</a>

                    <hr>

                    <!-- Buscador de usuarios -->

                            <div class="row">
                            <div class="col-md-8">
                                <h5>Lista de plantillas</h5>
                            </div>
                            <div class="col-md-4 pull-right">
                            {!! Form::open(['route' => 'admin.templates.index', 'method' => 'GET', ]) !!}

                            <div class="input-group">

                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar plantilla...', 'aria-describedby' => 'searchTags']) !!}

                               <span class="input-group-addon" id="searchTags"><span class="glyphicon glyphicon-search"
                                                                                      aria-hidden="true"></span></span>
                                </div>

                        {!! Form::close() !!}
                            </div>
                            </div>

                            <hr>

                        <!-- Fin buscador de usuarios -->


                            <table class='table table-hover'>

                                <thead>

                                <th>Nombre</th>

                                <th>Acción</th>
                                </thead>
                                <tbody>
                                @foreach($articlesTemplates as $articleTemplate)
                                    <tr>

                                        <td>{{$articleTemplate->name}}</td>


                                        <td>
                                            <a href="{{ route('admin.templates.edit', $articleTemplate->id)}}"
                                               class='button button-md'>
                                                <i class="fa fa-wrench"></i></a>


                                            {{-- <a href="{{ route('admin.tags.destroy', $category->id) }}" onclick="return confirm('Seguro que deseas eliminarlo?')" class=''><span class='fa-stack fa-lg ' aria-hidden='true'>
                                                       <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                                                      </span></a>--}}




                                            {{--{!! Form::open(['url'=> '/admin/tags/'.$tag->id, 'method' => 'DELETE', 'style' => 'display:block;', 'id' => 'tag_form_'.$tag->id]) !!}
                                            <input type="hidden" name="tag_id" value="{{$tag->id}}">
                                            <button class="button button-md" onclick='return confirm("¿Estas seguro?")' type="submit"><i class="fa fa-remove"></i></button>

                                            {!! Form::close() !!}
        --}}


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <div class="text-center">
                                {!! $articlesTemplates->render() !!}
                            </div>


                        </div>




                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addTemplate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva plantilla</h4>
                </div>

                {!! Form::open(['route' => 'admin.templates.store', 'method' => 'POST' ]) !!}

                <div class="modal-body">



                    <div class="form-group">

                        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre de la plantilla']) !!}
                    </div>

                    <div class="form-group">

                        {!! Form::textarea('description', null, ['class' => 'form-control', 'size' => '20x5', 'required', 'placeholder' => 'Descripción de la plantilla']) !!}
                    </div>

                    <p>Propiedades</p>

                    <div id="properties">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::text('option_1', null, ['class' => 'form-control', 'required', 'placeholder' => 'Agregue una propiedad como talla, color, entre otras', 'aria-describedby' => 'delete-form']) !!}
                                <span class="input-group-addon" id="delete-form"><a href="#" class="removeForm"><span class="glyphicon glyphicon-remove-sign"
                                                                                                                      aria-hidden="true"></span></a></span>
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <a href="#" id="addPropertyLink">Agregar otra propiedad <i class="fa fa-plus-square"></i></a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="button button-sm">Agregar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection