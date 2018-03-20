<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks'] = Task::all();
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['task'] = new Task();
        $data['tags'] = Tag::orderBy('text')->get();

        return view('tasks.store', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTask $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        $task = new Task();
        $task->text = $request->text;
        $task->description = $request->description;
        $task->user_id = Auth::id();
        $task->save();

        foreach ($request->tags as $tag_text) {
            $tag = Tag::findByText($tag_text)->first();

            if ($tag) {
                $task->tags()->attach($tag);
            } else {
                $task->tags()->create([
                    'text' => $tag_text,
                    'user_id' => Auth::id()
                ]);
            }
        }

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task  $task
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
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->text = $request->text;
        $task->description = $request->description;
        $task->save();

        $task->tags()->detach();

        foreach ($request->tags as $tag_text) {
            $tag = Tag::findByText($tag_text)->first();

            if ($tag) {
                $task->tags()->attach($tag);
            } else {
                $task->tags()->create([
                    'text' => $tag_text,
                    'user_id' => Auth::id()
                ]);
            }
        }

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->forceDelete();

        return redirect('/tasks');
    }
}
