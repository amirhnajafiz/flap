@extends('../../layouts.main')

@section('content')
    @if(session('name'))
        <div class="alert alert-success">User {{ session('name') }} Created Successfully!</div>
    @endif

    @if(count($users) > 0)
        <ul class="mt-4" style="list-style-type: none;">
            @foreach($users as $user)
                <li class="border-bottom border-2">
                    <x-Item title="{{ $user->name }}" content="{{ $user->email }}">
                    </x-Item>
                    <ul class="bg-primary p-2 rounded-1">
                        @foreach($user->tasks as $task)
                            <x-item
                                title="{{ $task->title }}"
                                content='{{ strlen($task->description) > 50 ? substr($task->description, 0, 47) . "..." : $task->description }}'>
                            </x-item>
                            <a class="text-dark" href="{{ route('task.show', $task) }}" target="_blank">
                                View task
                            </a>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alter alert-danger mt-4 p-2 rounded">
            No users yet.
        </div>
    @endif

@stop
