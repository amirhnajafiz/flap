@extends('../../layouts.main')

@section('content')
    <h2 class="d-inline-block">
        Recently Deleted
    </h2>

    <small class="d-block">
        Total: {{ count($tasks) }} tasks
    </small>

    @if(count($tasks) > 0)
        <ul class="mt-4 p-0" style="list-style-type: none;">
            @foreach($tasks as $task)
                <li>
                    <x-item
                        title="{{ $task->title }}"
                        content="{{ strlen($task->description) > 50 ? substr($task->description, 0, 30) . ' ...' : $task->description }}"
                        more='{{ "Deleted at " . $task->deleted_at }}'
                    >
                    </x-item>
                    <div class="d-flex justify-content-between px-2">
                        <form action="{{ route('task.force', $task) }}" method="post" class="d-inline-block">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                            <small>
                                If you delete this, you won't be able to restore it.
                            </small>
                        </form>
                        <form action="{{ route('task.restore', $task) }}" method="post" class="d-inline-block">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-success">
                                Restore
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alter alert-danger mt-4 p-2 rounded">
            No tasks yet.
        </div>
    @endif
@stop
