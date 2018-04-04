<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Project create.
     */
    public function testCreate()
    {
        $user = factory(User::class)->create();
        $data = [
            'name' => 'Project name',
            'description' => 'Project description'
        ];

        $this->actingAs($user)->post('/projects', $data);

        $data['user_id'] = $user->id;
        $this->assertDatabaseHas('projects', $data);
    }

    /**
     * Project validations.
     */
    public function testValidations()
    {
        $user = factory(User::class)->create();
        $data = ['name' => ''];

        $response = $this->actingAs($user)->post('/projects', $data);

        $response->assertSessionHasErrors(['name']);
        $response->assertSessionMissing(['description']);
        $this->assertDatabaseMissing('projects', $data);
    }

    /**
     * Project update.
     */
    public function testUpdate()
    {
        $project = factory(Project::class)->create();
        $user = User::find($project->user_id);
        $data = [
            'name' => 'Project name updated',
            'description' => 'Project description updated'
        ];

        $this->actingAs($user)->put('/projects/' . $project->id, $data);

        $data['id'] = $project->id;
        $this->assertDatabaseHas('projects', $data);
    }

    /**
     * Project delete.
     */
    public function testDelete()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->create(['project_id' => $project->id]);
        $user = User::find($project->user_id);

        $this->actingAs($user)->delete('/projects/' . $project->id);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

}
