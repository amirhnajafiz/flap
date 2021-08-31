@extends('../../layouts.main')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">Task Created Successfully!</div>
    @endif

    <a href="{{ route('task.create') }}" class="btn btn-primary">Create Task</a>

    @if(count($tasks) > 0)
        <ul class="mt-4" style="list-style-type: none;">
            @foreach($tasks as $task)
                <li class="border-bottom border-2 mb-2 pb-2">
                    <div>
                        {{ $task->title }}
                    </div>
                    <div>
                        {{ $task->description }}
                    </div>
                    Update at {{ $task->updated_at }} by {{ $task->name }}
                </li>
            @endforeach
        </ul>
    @else
        <div class="alter alert-danger mt-4 p-2 rounded">
            No users yet.
        </div>
    @endif
@stop
