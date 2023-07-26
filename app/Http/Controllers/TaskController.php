<?php

namespace App\Http\Controllers;

use App\Enum\TaskStatuses;
use App\Http\Requests\CreateTaskRequest;
use App\Models\IssueTypes;
use App\Models\Task;
use App\Models\User;
use App\Models\Worklog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function get()
    {
        $tasks = Task::query()
            ->with([
                'creator' => static function (BelongsTo $query) {
                    return $query->select(['id', 'name']);
                },
                'assignee' => static function (BelongsTo $query) {
                    return $query->select(['id', 'name']);
                },
                'tester' => static function (BelongsTo $query) {
                    return $query->select(['id', 'name']);
                },
                'issueTypes' => static function (HasOne $query) {
                    return $query->select(['id', 'title']);
                }
            ])
            ->get();


        return view('tasks.get', compact('tasks'));
    }

    public function create(): View
    {
        $users = User::all();
        $loggedInUser = Auth::user();
        $issueTypes = IssueTypes::all();
        $taskStatuses = TaskStatuses::getValues();

        return view('tasks.create', compact('users', 'loggedInUser', 'issueTypes', 'taskStatuses'));
    }

    public function store(CreateTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $task = Task::create($data);

        Worklog::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'event' => 'Task created',
        ]);

        return redirect()->route('tasks.get')->with('success', 'Task created successfully!');
    }

    public function edit(int $id): View
    {
        $task = Task::find($id);
        $users = User::all();
        $issueTypes = IssueTypes::all();
        $taskStatuses = TaskStatuses::getValues();

        return view('tasks.edit', compact('task', 'users', 'issueTypes', 'taskStatuses'));
    }


    public function update(Request $request, int $id): RedirectResponse
    {
        $task = Task::find($id);
        $data = $request->all();
        $task->update($data);

        Worklog::create([
            'task_id' => $id,
            'user_id' => Auth::id(),
            'event' => 'Task updated',
        ]);

        return redirect()->route('tasks.get')->with('success', 'Task updated successfully!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('tasks.get')->with('success', 'Task deleted successfully!');
    }

    public function showSingle(int $id): View
    {
        $task = Task::query()
            ->with([
                'creator' => static function (BelongsTo $query) {
                    return $query->select(['id', 'name']);
                },
                'assignee' => static function (BelongsTo $query) {
                    return $query->select(['id', 'name']);
                },
                'tester' => static function (BelongsTo $query) {
                    return $query->select(['id', 'name']);
                },
                'issueTypes' => static function (HasOne $query) {
                    return $query->select(['id', 'title']);
                },
                'comments',
                'comments.user',
                'worklogs',
            ])
            ->find($id);

        return view('tasks.showSingle', compact('task'));
    }
}
