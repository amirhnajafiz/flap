<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 rounded p-2">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link {{ !request()->routeIs('user.index') ?: 'active' }}" href="{{ route('user.index') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ !request()->routeIs('user.create') ?: 'active' }}" href="{{ route('user.create') }}">Create User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ !request()->routeIs('task.index') ?: 'active' }}" href="{{ route('task.index') }}">Tasks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ !request()->routeIs('task.create') ?: 'active' }}" href="{{ route('task.create') }}">Create Task</a>
            </li>
        </ul>
    </nav>
</div>
