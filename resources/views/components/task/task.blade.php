@extends('../../layouts.main')

@section('content')
    @if(session('status'))
        <div class="alert alert-success">Task Created Successfully!</div>
    @endif

    @if( \Illuminate\Support\Facades\Auth::check() )
    <a href="{{ route('task.create') }}" class="btn btn-primary">Create Task</a>
    @endif

    @if(count($tasks) > 0)
        <ul class="mt-4" style="list-style-type: none;">
            @foreach($tasks as $task)
                <li class="border-bottom border-2">
                    <x-item title="{{ $task->title }}" content="{{ $task->description }}" more='{{ "Update at " . $task->updated_at . " by " . $task->user->name }}'>
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
