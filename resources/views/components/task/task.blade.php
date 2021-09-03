@extends('../../layouts.main')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">Task Created Successfully!</div>
    @endif

    <h2 class="d-inline-block">
        View tasks
    </h2>
    <a href="{{ route('task.create') }}" class="btn btn-primary float-end">Create Task</a>

    @if(count($tasks) > 0)
        <ul class="mt-4 p-0" style="list-style-type: none;">
            @foreach($tasks as $task)
                <li>
                    <x-item
                        title="{{ $task->title }}"
                        content="{{ strlen($task->description) > 50 ? substr($task->description, 0, 30) . ' ...' : $task->description }}"
                        more='{{ "Update at " . $task->updated_at . " by " . $task->user->name }}'
                        link="{{ route('task.show', $task) }}"
                    >
                    </x-item>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alter alert-danger mt-4 p-2 rounded">
            No users yet.
        </div>
    @endif
@stop
