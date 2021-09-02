<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 rounded p-2">
        <ul class="navbar-nav">
            @if( !\Illuminate\Support\Facades\Auth::check() )
                <li class="nav-item active">
                    <a class="nav-link {{ !request()->routeIs('login.page') ?: 'active' }}" href="{{ route('login.page') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->routeIs('user.create') ?: 'active' }}" href="{{ route('user.create') }}">Create User</a>
                </li>
            @endif
            @if( \Illuminate\Support\Facades\Auth::check() )
                <li class="nav-item active">
                    <a class="nav-link {{ !request()->routeIs('user.index') ?: 'active' }}" href="{{ route('user.index') }}">Users</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ !request()->routeIs('task.index') ?: 'active' }}" href="{{ route('task.index') }}">Tasks</a>
            </li>
            @if( \Illuminate\Support\Facades\Auth::check() )
                <li class="nav-item">
                    <a class="nav-link {{ !request()->routeIs('task.create') ?: 'active' }}" href="{{ route('task.create') }}">Create Task</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn-danger">
                            Logout
                        </button>
                    </form>
                </li>
            @endif
        </ul>
    </nav>
</div>
