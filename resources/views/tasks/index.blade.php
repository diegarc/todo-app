@extends('layouts.base')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tareas

            @isset($project)
                <small><a href="/projects/{{ $project->id }}/edit">{{ $project->name }}</a></small>
            @endisset

            @if(isset($starred) && $starred)
                <small>Destacadas</small>
            @endif
        </h1>
        @isset($project)

            @if($project->description)
                <p class="text-muted">{{ $project->description }}</p>
            @endif

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <button data-id="{{ $project->id }}" type="button" class="btn btn-box-tool project-delete">
                        <i class="fa fa-remove"></i>
                    </button>
                </li>
            </ol>
        @endif
    </section>

    <!-- Main content -->
    <section class="content">

        @if(isset($project))
            <a href="/tasks/create/{{ $project->id }}" class="btn btn-info margin-bottom">Nueva tarea</a>
        @elseif(isset($starred) && $starred)
            <a href="/tasks/create/starred" class="btn btn-info margin-bottom">Nueva tarea</a>
        @else
            <a href="/tasks/create" class="btn btn-info margin-bottom">Nueva tarea</a>
        @endif

        <div class="box">
            <div class="box-body">
                <div class="mailbox-messages">
                    <table class="table table-hover table-striped table-responsive">
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td width="50"><input type="checkbox" data-id="{{ $task->id }}"></td>
                                <td width="40" class="mailbox-star">
                                    <a href="#">
                                        <i class="fa {{ $task->starred ? 'fa-star' : 'fa-star-o' }} text-yellow"></i>
                                    </a>
                                </td>
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
                                    <button data-id="{{ $task->id }}" type="button" class="btn btn-box-tool task-delete">
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

    <form id="task-done-frm" method="post">
        @csrf
        @method('DELETE')
    </form>

    <form id="task-delete-frm" method="post">
        @csrf
        @method('DELETE')
    </form>

    <form id="project-delete-frm" method="post">
        @csrf
        @method('DELETE')
    </form>
@endsection