<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks'] = Task::whereNull('project_id')->get();
        $data['done'] = Task::whereNull('project_id')->onlyTrashed()->get();
        return view('tasks.index', $data);
    }

    /**
     * Display a listing of starred tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function starred()
    {
        $data['tasks'] = Task::where('starred', true)->get();
        $data['done'] = Task::where('starred', true)->onlyTrashed()->get();
        $data['starred'] = true;
        return view('tasks.index', $data);
    }

    /**
     * Display a listing of starred tasks.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function byProject(Project $project)
    {
        $data['tasks'] = Task::where('project_id', $project->id)->get();
        $data['done'] = Task::where('project_id', $project->id)->onlyTrashed()->get();
        $data['project'] = $project;
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $projectId
     * @return \Illuminate\Http\Response
     */
    public function create($projectId = null)
    {
        $task = new Task();
        $task->project_id = $projectId;
        $task->priority_id = 2;

        $data['task'] = $task;
        $data['tags'] = Tag::orderBy('text')->get();

        return view('tasks.store', $data);
    }

    /**
     * Show the form for creating a new starred resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStarred()
    {
        $task = new Task();
        $task->starred = true;
        $task->priority_id = 2;

        $data['task'] = $task;
        $data['tags'] = Tag::orderBy('text')->get();

        return view('tasks.store', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTask $request
     * @param TaskRepository $taskRepository
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request, TaskRepository $taskRepository)
    {
        $task = $taskRepository->store($request->all());
        return $this->afterStoredRedirect($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $data['task'] = $task;
        $data['tags'] = Tag::orderBy('text')->get();

        return view('tasks.store', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTask $request
     * @param Task $task
     * @param TaskRepository $taskRepository
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTask $request, Task $task, TaskRepository $taskRepository)
    {
        $task = $taskRepository->store($request->all(), $task);
        return $this->afterStoredRedirect($task);
    }

    /**
     * After stored redirect.
     *
     * @param $task
     * @return \Illuminate\Http\RedirectResponse
     */
    private function afterStoredRedirect($task)
    {
        if ($task->project_id) {
            return redirect('/tasks/project/' . $task->project_id);
        } elseif ($task->starred) {
            return redirect('/tasks/starred');
        } else {
            return redirect('/tasks');
        }
    }

    /**
     * Update the starred attribute of the specified resource in storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStarred(Task $task)
    {
        $task->starred = !$task->starred;
        $task->save();

        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function undone($taskId)
    {
        $task = Task::onlyTrashed()->where('id', $taskId)->first();
        $task->restore();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function done(Task $task)
    {
        $task->delete();

        return back();
    }

    /**
     * Destroy the specified resource from storage.
     *
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->forceDelete();

        return back();
    }
}
