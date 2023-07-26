@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Route::has('tasks.get'))
                        <a class="btn btn-link" href="{{ route('tasks.get') }}">
                            {{ __('Tasks') }}
                        </a>
                    @endif

                    @if (Route::has('tasks.create'))
                        <a class="btn btn-link" href="{{ route('tasks.create') }}">
                            {{ __('Create task') }}
                        </a>
                    @endif

                    @if (Route::has('issue.index'))
                        <a class="btn btn-link" href="{{ route('issue.index') }}">
                            {{ __('Issue types') }}
                        </a>
                    @endif
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
