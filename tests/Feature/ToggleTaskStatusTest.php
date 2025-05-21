<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToggleTaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_toggle_task_status()
    {
        $task = Task::create(['name' => 'Test Task', 'is_done' => false]);

        $response = $this->post(route('tasks.toggle', $task->id));
        $response->assertRedirect();
        $this->assertTrue($task->fresh()->is_done);

        $this->post(route('tasks.toggle', $task->id));
        $this->assertFalse($task->fresh()->is_done);
    }
}
