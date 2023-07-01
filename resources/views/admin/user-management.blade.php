<!-- resources/views/admin/user-management.blade.php -->
<h1>User Management</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Notifications</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->notification_switch == 1 ? $user->unreadNotificationCount() : null }}</td>
            <td>
                <form method="POST" action="{{ route('admin.impersonate', $user) }}">
                    @csrf
                    <button type="submit">Impersonate</button>
                </form>
            </td>
            <td>
                    @if ($user->isImpersonating)
                    <form action="{{ route('admin.stop-impersonating') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <button type="submit">Stop Impersonation</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
