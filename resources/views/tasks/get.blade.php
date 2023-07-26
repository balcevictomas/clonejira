@php
    use App\Enum\TaskStatuses;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tasks') }}</div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td>ID</td>
                                <td>Title</td>
                                <td>Type</td>
                                <td>Description</td>
                                <td>Creator</td>
                                <td>Tester</td>
                                <td>Assignee</td>
                                <td>Status</td>
                            </tr>
                            @foreach($tasks as $task)
                                <tr>
                                    <th>{{$task->id}}</th>
                                    <th>{{$task->title}}</th>
                                    <th>{{$task->issueTypes->title}}</th>
                                    <th class="max-text">{{$task->description}}</th>
                                    <th>{{$task->creator->name}}</th>
                                    <th>{{$task->tester->name ?? 'Not assigned'}}</th>
                                    <th>{{$task->assignee->name ?? 'Not assigned'}}</th>
                                    <th>{{TaskStatuses::getStatusNameById($task->status_id)}}</th>
                                    <td class="d-flex align-items-center gap-2">
                                        <a href="{{ route('task.edit', ['id' => $task->id]) }}">Edit</a>
                                        <a href="{{ route('task.show', ['id' => $task->id]) }}">Show</a>
                                        <form class="d-flex align-items-center" action="{{ route('task.delete', ['id' => $task->id]) }}" method="post">
                                            @csrf
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .max-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    td {
        padding: 5px;
    }

    .gap-2 > * + * {
        margin-left: 10px;
    }
</style>
