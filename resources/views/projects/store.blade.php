@extends('layouts.base')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $project->id ? 'Modificar' : 'Crear' }} proyecto</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- form start -->
            <form role="form" action="{{ $project->id ? '/projects/' . $project->id : '/projects' }}" method="post">
                @csrf

                @if($project->id)
                    @method('PUT')
                @endif

                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                            <input type="text" name="name" value="{{ $project->name }}" class="form-control"
                                   placeholder="Nombre">
                        </div>
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <textarea name="description" class="form-control" rows="5"
                                  placeholder="Descripción">{{ $project->description }}</textarea>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>

                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection