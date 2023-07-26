@php
    use App\Enum\TaskStatuses;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Task') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input type="text" class="form-control" id="title" name="title" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">{{ __('Issue type') }}</label>
                                <select class="form-select" id="type" name="type" required>
                                    @foreach($issueTypes as $value)
                                        <option value="{{ $value->id }}">{{ ucfirst(strtolower($value->title)) }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="creator_id" class="form-label">{{ __('Creator') }}</label>
                                <select class="form-select" id="creator_id" name="creator_id" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id === $loggedInUser->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="assignee_id" class="form-label">{{ __('Assignee') }}</label>
                                <select class="form-select" id="assignee_id" name="assignee_id">
                                    <option value="" selected disabled>Select Assignee</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tester_id" class="form-label">{{ __('Tester') }}</label>
                                <select class="form-select" id="tester_id" name="tester_id">
                                    <option value="" selected disabled>Select Assignee</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <label for="status_id" class="form-label">{{ __('Status') }}</label>
                            <select class="form-select" id="status_id" name="status_id" required>
                                @foreach($taskStatuses as $status)
                                    <option value="{{ $status->value }}">{{ TaskStatuses::getStatusName($status) }}</option>
                                @endforeach
                            </select>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
