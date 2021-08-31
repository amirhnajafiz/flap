@extends('../../layouts.main')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">Task {{ session('status') }} Created Successfully!</div>
    @endif

    <a href="{{ route('task.create') }}" class="btn btn-primary">Create Task</a>

    @if(count($tasks) > 0)
        <ul class="mt-4">
            @foreach($tasks as $task)
                <li>{{ $task->title }} ({{ $task->description }})</li>
            @endforeach
        </ul>
    @else
        <div class="alter alert-danger">
            No users yet.
        </div>
    @endif
@stop
