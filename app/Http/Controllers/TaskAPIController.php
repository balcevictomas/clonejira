<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\Worklog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskAPIController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::with(['creator', 'assignee', 'tester', 'issueTypes', 'comments', 'worklogs'])
            ->get();

        return response()->json(['tasks' => $tasks]);
    }

    public function show(int $id): JsonResponse
    {
        $task = Task::with(['creator', 'assignee', 'tester', 'issueTypes', 'comments', 'worklogs'])
            ->find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['task' => $task]);
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        $task = Task::create($data);

        Worklog::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'event' => 'Task created',
        ]);

        return response()->json(['message' => 'Task created successfully', 'task' => $task]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $data = $request->all();
        $task->update($data);

        Worklog::create([
            'task_id' => $id,
            'user_id' => auth()->id(),
            'event' => 'Task updated',
        ]);

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    public function destroy(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}

