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
            <form role="form">
                <div class="box-body">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                        <input type="email" class="form-control" placeholder="Nombre de la tarea">
                    </div>
                    <br/>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        <select class="form-control select2" multiple="multiple" data-placeholder="Etiquetas">
                        </select>
                    </div>
                    <br/>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                        <textarea class="form-control" rows="5" placeholder="Notas"></textarea>
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