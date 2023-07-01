<!-- resources/views/admin/dashboard.blade.php -->
<h1>Welcome to the Admin Dashboard</h1>

<!-- Add your dashboard content here -->

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>


<a href = "{{ route('admin.user-management') }}" class="btn btn-lg btn-primary">User Management</a>
<a href = "{{ route('admin.create-notification') }}" class="btn btn-lg btn-primary">Notification Management</a>
