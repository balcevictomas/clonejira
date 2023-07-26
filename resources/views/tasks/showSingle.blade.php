@php
    use App\Enum\TaskStatuses;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $task->title }}</div>

                    <div class="card-body">
                        <div>
                            Creator: {{ $task->creator->name }}
                        </div>
                        <div>
                            Issue Type: {{ $task->issueTypes->title }}
                        </div>
                        <div>
                            Issue Status: {{ TaskStatuses::getStatusNameById($task->status_id) }}
                        </div>
                        <div>
                            Assignee: {{ $task->assignee->name ?? 'Not assigned' }}
                        </div>
                        <div>
                            Tester: {{ $task->tester->name ?? 'Not assigned' }}
                        </div>
                        <div>
                            Description: {{ $task->description }}
                        </div>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="card mt-3">
                    <div class="card-header">Comments</div>

                    <div class="card-body">
                        @if ($task->comments->count() > 0)
                            <ul class="list-group">
                                @foreach ($task->comments as $comment)
                                    <li class="list-group-item">
                                        <strong>{{ $comment->user->name }}:</strong>
                                        {{ $comment->content }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No comments yet.</p>
                        @endif
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Add Comment</div>

                    <div class="card-body">
                        <form action="{{ route('comments.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div class="mb-3">
                                <label for="content" class="form-label">Comment:</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Work Logs</div>

                    <div class="card-body">
                        @if ($task->workLogs->count() > 0)
                            <ul class="list-group">
                                @foreach ($task->workLogs as $workLog)
                                    <li class="list-group-item">
                                        <strong>{{ $workLog->user->name }}:</strong>
                                        {{ $workLog->event }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No work logs yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
