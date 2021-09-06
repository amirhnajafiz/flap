@extends('../../layouts.main')

@section('content')
    <div class="card border-success mb-3 p-2 text-dark">
        <div class="card-header bg-transparent border-success">
            {{ $task->title }}
        </div>
        <div class="card-body text-success">
            <p class="card-text">
                {{ $task->description }}
            </p>
        </div>
        <div class="card-footer bg-transparent border-success">
            <div class="mb-2">
                Owner: {{ $task->user->name }}
            </div>
            <small class="d-block">
                Created at: {{ $task->created_at }}
            </small>
            <small class="d-block">
                Last update: {{ $task->updated_at }}
            </small>
        </div>
    </div>
    @if($task->user->id == \Illuminate\Support\Facades\Auth::id())
        <form action="{{ route('task.update', $task) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-{{ $task->is_done == 0 ? 'success' : 'warning' }} mb-2 float-end">
                {{ $task->is_done == 1 ? 'Undo' : 'Done' }}
            </button>
        </form>
        <form action="{{ route('task.delete', $task) }}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="btn btn-danger d-block">
                Delete
            </button>
        </form>
    @endif
@stop
