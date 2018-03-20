@extends('layouts.base')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tareas</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <a href="/tasks/create" class="btn btn-info margin-bottom">Nueva tarea</a>

        <div class="box">
            <div class="box-body">
                <div class="mailbox-messages">
                    <table class="table table-hover table-striped table-responsive">
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td width="50"><input type="checkbox"></td>
                                <td class="mailbox-name">
                                    <a href="/tasks/{{ $task->id }}/edit">{{ $task->text }}</a>
                                    <p class="text-muted no-margin">{{ $task->description }}</p>
                                </td>
                                <td class="mailbox-name text-right">
                                    @foreach($task->tags as $tag)
                                        <div class="badge badge-dark">{{ $tag->text }}</div>
                                    @endforeach
                                </td>
                                <td width="20">
                                    <button data-id="{{ $task->id }}" type="button" class="btn btn-box-tool task-delete" data-toggle="tooltip" title="" data-original-title="Delete">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>

    <form id="task-delete-frm" method="post">
        @csrf
        @method('DELETE')
    </form>
@endsection