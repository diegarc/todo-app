<?php

namespace Tests\Feature;

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

        $this->assertDatabaseHas('projects', $data);
    }

    /**
     * Project create validations.
     */
    public function testCreateValidation()
    {
        $user = factory(User::class)->create();
        $data = ['name' => ''];

        $response = $this->actingAs($user)->post('/projects', $data);

        $response->assertSessionHasErrors(['name']);
        $response->assertSessionMissing(['description']);
        $this->assertDatabaseMissing('projects', $data);
    }
}
