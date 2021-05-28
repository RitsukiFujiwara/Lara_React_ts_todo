<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $tasks = Task::factory()->count(10)->create();
        $response = $this->getJson('api/tasks');
        $response->assertStatus(200)
                 ->assertJsonCount($tasks->count());
    }
}
