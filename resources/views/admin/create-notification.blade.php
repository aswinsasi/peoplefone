<h1>Send Notification</h1>
<form method="POST" action="{{ route('notifications.send') }}">
    @csrf

    <div>
        <label for="type">Notification Type:</label>
        <select name="type" id="type">
            <option value="marketing">Marketing</option>
            <option value="invoices">Invoices</option>
            <option value="system">System</option>
        </select>
    </div>

    <div>
        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="3"></textarea>
    </div>

    <div>
        <label for="expiration">Expiration:</label>
        <input type="datetime-local" name="expiration" id="expiration">
    </div>

    <div>
        <label for="destination">Destination:</label>
        <select name="destination" id="destination">
            <option value="all">All Users</option>
            <option value="single">Single User</option>
        </select>
    </div>

    <div id="user-dropdown" style="display: none;">
        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Send Notification</button>
</form>

<script>
    document.getElementById('destination').addEventListener('change', function() {
        var userDropdown = document.getElementById('user-dropdown');
        userDropdown.style.display = this.value === 'single' ? 'block' : 'none';
    });
</script>
