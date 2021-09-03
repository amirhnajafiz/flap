<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 rounded p-2">
        <ul class="navbar-nav w-100">
            @if( !\Illuminate\Support\Facades\Auth::check() )
                <li class="nav-item active">
                    <a class="nav-link {{ !request()->routeIs('login.page') ?: 'active' }}" href="{{ route('login.page') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->routeIs('user.create') ?: 'active' }}" href="{{ route('user.create') }}">Register</a>
                </li>
            @endif
            @if( \Illuminate\Support\Facades\Auth::check() )
                <li class="nav-item active">
                    <a class="nav-link {{ !request()->routeIs('user.index') ?: 'active' }}" href="{{ route('user.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->routeIs('task.index') ?: 'active' }}" href="{{ route('task.index', \Illuminate\Support\Facades\Auth::user()) }}">Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ !request()->routeIs('task.create') ?: 'active' }}" href="{{ route('task.create') }}">Create Task</a>
                </li>
            @endif
        </ul>
        @if( \Illuminate\Support\Facades\Auth::check() )
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link btn-danger text-light rounded-1">
                Logout
            </button>
        </form>
        @endif
    </nav>
</div>
