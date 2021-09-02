@extends('../layouts.main')

@section('content')
    @if(session('name'))
        <div class="alert alert-success">User {{ session('name') }} Created Successfully!</div>
    @endif

    <a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>

    @if(count($users) > 0)
        <ul class="mt-4" style="list-style-type: none;">
            @foreach($users as $user)
                <li class="border-bottom border-2">
                    <x-Item title="{{ $user->name }}" content="{{ $user->email }}">
                    </x-Item>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alter alert-danger mt-4 p-2 rounded">
            No users yet.
        </div>
    @endif

@stop
