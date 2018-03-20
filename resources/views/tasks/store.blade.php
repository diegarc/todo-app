@extends('layouts.base')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $task->id ? 'Modificar' : 'Crear' }} tarea</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- form start -->
            <form role="form" action="{{ $task->id ? '/tasks/' . $task->id : '/tasks' }}" method="post">
                @csrf

                @if($task->id)
                    @method('PUT')
                @endif

                <div class="box-body">
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                            <input type="text" name="text" value="{{ $task->text }}" class="form-control"
                                   placeholder="Tarea">
                        </div>
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <select name="tags[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Etiquetas">
                            @foreach($tags as $tag)
                                <option {{ $task->tags->pluck('id')->search($tag->id) !== false ? 'selected' : '' }}>{{ $tag->text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br/>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <textarea name="description" class="form-control" rows="5"
                                  placeholder="Notas">{{ $task->description }}</textarea>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="/tasks" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection