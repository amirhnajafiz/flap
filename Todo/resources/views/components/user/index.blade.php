@extends('../../layouts.main')

@section('content')
    <h2>
        See all the users
    </h2>
    <div class="d-flex justify-content-between p-2">
        @if($offset - 3 >= 0)
            <form action="{{ route('user.index', $offset - 3) }}" method="get">
                <button type="submit" class="btn btn-primary">
                    Prev
                </button>
            </form>
        @else
            <button class="disabled btn btn-secondary">
                Prev
            </button>
        @endif
        <span>
            {{ "( " . ($offset+1) . " from " . $total . " )" }}
        </span>
        @if($offset + 3 < $total)
            <form action="{{ route('user.index', $offset + 3) }}" method="get">
                <button type="submit" class="btn btn-primary">
                    Next
                </button>
            </form>
        @else
            <button class="disabled btn btn-secondary">
                Next
            </button>
        @endif
    </div>
    @if(count($users) > 0)
        <ul class="mt-4 p-0" style="list-style-type: none;">
            @foreach($users as $user)
                <li>
                    <x-Item
                        title="{{ $user->name }}"
                        content="{{ $user->email }}"
                        more='{{ "Joined: " . $user->created_at }}'
                        link="{{ route('task.index', $user) }}"
                    >
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
