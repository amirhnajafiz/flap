@extends('../../layouts.main')

@section('content')
    <h2>
        See all the users
    </h2>
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
