<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    /**
     * Store a newly created resource in storage.
     *
     * @param $data
     * @param Task $task
     * @return Task
     */
    public function store($data, Task $task = null)
    {
        if ($task === null) {
            $task = new Task();
        }

        $task->text = $data['text'];
        $task->description = $data['description'];
        $task->starred = isset($data['starred']) ? boolval($data['starred']) : false;
        $task->due_at = $data['due_at'];
        $task->project_id = $data['project'];
        $task->user_id = Auth::id();
        $task->save();

        $task->tags()->detach();

        if ($data['tags']) {
            foreach ($data['tags'] as $tag_text) {
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
        }

        return $task;
    }
}