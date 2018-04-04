<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Task create.
     */
    public function testCreate()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $data = [
            'text' => 'Task name',
            'description' => 'Task description',
            'starred' => true,
            'due_at' => Carbon::today()->toDateString(),
            'project_id' => $project->id,
            'priority_id' => 1,
        ];

        $this->actingAs($user)->post('/tasks', $data);

        $data['user_id'] = $user->id;
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * Task validations.
     */
    public function testValidations()
    {
        $user = factory(User::class)->create();
        $data = ['text' => ''];

        $response = $this->actingAs($user)->post('/tasks', $data);

        $response->assertSessionHasErrors(['text']);
        $response->assertSessionMissing(['description', 'starred', 'due_at', 'project_id', 'priority_id']);
        $this->assertDatabaseMissing('tasks', $data);
    }

    /**
     * Task update.
     */
    public function testUpdate()
    {
        $task = factory(Task::class)->create();
        $user = User::find($task->user_id);
        $data = [
            'text' => 'Task name',
            'description' => 'Task description',
            'starred' => true,
            'due_at' => Carbon::today()->toDateString(),
            'project_id' => null,
            'priority_id' => 3,
        ];

        $this->actingAs($user)->put('/tasks/' . $task->id, $data);

        $data['id'] = $task->id;
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * Task delete.
     */
    public function testDelete()
    {
        $task = factory(Task::class)->create();
        $user = User::find($task->user_id);

        $this->actingAs($user)->delete('/tasks/' . $task->id);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
