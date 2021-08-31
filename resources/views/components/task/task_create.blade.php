@extends('../../layouts.main')

@section('content')
    <form class="mt-4" method="post" action="{{ route('task.store') }}">
        @csrf

        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleInputName1" name="title">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="description">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">User</label>
            <select class="form-control" id="exampleInputPassword1" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="is_done" value="0" />

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
