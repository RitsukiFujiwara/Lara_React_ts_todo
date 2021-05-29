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

    public function test_regist()
    {
        $data = [
            'title' => 'テスト投稿'
        ];
        $response = $this->postJson('api/tasks', $data);
        $response->assertCreated()
                 ->assertJsonFragment($data);
    }

    public function test_update()
    {
        $task = Task::factory()->create();
        $task->title = '書き換え';
        $response = $this->patchJson("api/tasks/{$task->id}", $task->toArray());
        $response->assertOk()
                 ->assertJsonFragment($task->toArray());
    }

    public function test_delete()
    {
        $tasks = Task::factory()->count(10)->create();
        
        $response = $this->deleteJson("api/tasks/1");
        $response->assertOk();
        $response = $this->getJson("api/tasks");
        $response->assertJsonCount($tasks->count() -1);
    }
}


