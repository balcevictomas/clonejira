@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Issue types') }}</div>

                    <div class="card-body">
                        @if(count($issueTypes) > 0)
                            <table>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                </tr>
                                @foreach($issueTypes as $type)
                                    <tr>
                                        <td>
                                            {{ $type->id }}
                                        </td>
                                        <td>
                                            {{ $type->title }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <span>No types</span>
                        @endif
                    </div>
                </div>
                @if (Route::has('issue.create'))
                    <a class="btn btn-link" href="{{ route('issue.create') }}">
                        {{ __('Create issue type') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
