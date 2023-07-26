<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\IssueTypes;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskBelongsToCreator(): void
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(User::class, $task->creator);
    }

    public function testTaskBelongsToAssignee(): void
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(User::class, $task->assignee);
    }

    public function testTaskBelongsToTester(): void
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(User::class, $task->tester);
    }
}
