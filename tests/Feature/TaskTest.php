<?php

namespace Tests\Feature;

use App\Models\Project;
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
}
