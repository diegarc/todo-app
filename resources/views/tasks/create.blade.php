@extends('layouts.base')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Crear tarea</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- form start -->
            <form role="form" action="/tasks" method="post">
                @csrf
                <div class="box-body">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                        <input type="text" name="text" class="form-control" placeholder="Tarea">
                    </div>
                    <br/>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <select name="tags[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Etiquetas">
                            @foreach($tags as $tag)
                                <option>{{ $tag->text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br/>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <textarea name="description" class="form-control" rows="5" placeholder="Notas"></textarea>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <button type="submit" class="btn btn-default">Cancelar</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection