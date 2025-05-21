<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_is_done_is_false()
    {
        $task = Task::create(['name' => 'Baru']);
        $this->assertFalse($task->is_done);
    }

    public function test_can_update_is_done()
    {
        $task = Task::create(['name' => 'Tes']);
        $task->update(['is_done' => true]);
        $this->assertTrue($task->fresh()->is_done);
    }
}
