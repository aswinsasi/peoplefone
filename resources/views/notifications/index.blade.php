@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Notifications</h1>

        @if ($notifications->isEmpty())
            <p>No notifications found.</p>
        @else
            <ul class="notification-list">
                @foreach ($notifications as $notification)
                    <li class="notification">
                        <h3>{{ $notification->type }}</h3>
                        <p>{{ $notification->message }}</p>
                        <p>Created at: {{ $notification->created_at }}</p>
                        @if (!$notification->is_read)
                            <form action="{{ route('notifications.update', $notification) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit">Mark as Read</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>

            {{ $notifications->links() }}
        @endif
    </div>
@endsection
