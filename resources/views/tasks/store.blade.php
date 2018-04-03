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

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <input type="checkbox" name="starred" id="starred" {{ $task->starred ? 'checked' : '' }}>
                                <label for="starred">Destacada</label>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Prioridad</label>
                        </div>

                        <div class="col-sm-4">
                            <input id="priority_1" name="priority_id" type="radio" class="with-gap" value="1" {{ $task->priority_id == 1 ? 'checked' : '' }} />
                            <label for="priority_1">Alta</label>
                            <input id="priority_2" name="priority_id" type="radio" class="with-gap" value="2" {{ $task->priority_id == 2 ? 'checked' : '' }} />
                            <label for="priority_2">Media</label>
                            <input id="priority_3" name="priority_id" type="radio" class="with-gap" value="3" {{ $task->priority_id == 3 ? 'checked' : '' }} />
                            <label for="priority_3">Baja</label>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                            <input type="text" name="text" value="{{ $task->text }}" class="form-control"
                                   placeholder="Tarea">
                        </div>
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    </div>

                    <div class="row margin-bottom">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-folder"></i></span>
                                <select id="project" name="project" class="form-control select2"
                                        data-placeholder="Proyecto">
                                    <option></option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ $project->id == $task->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" autocomplete="off" class="form-control pull-right" id="datepicker"
                                       name="due_at" value="{{ $task->due_at ? $task->due_at->toDateString() : '' }}"
                                       readonly>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <select id="tags" name="tags[]" class="form-control select2" multiple="multiple"
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
                    <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection