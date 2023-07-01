@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="top-bar">
                    <a href="{{ route('notifications.index') }}">
                        <i class="fa fa-bell" style="font-size:36px"></i>
                        @if (isset($unreadNotificationCount) && auth()->user()->notification_switch == 1 && $unreadNotificationCount > 0)
                            <span class="notification-counter">{{ $unreadNotificationCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Welcome, {{ auth()->user()->name }}</h1>
                    <p>Email: {{ auth()->user()->email }}</p>
                  

                    <hr>

                <h2>Edit Profile</h2>

                <form method="POST" action="{{ route('users.update', auth()->user()->id) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" required>
                    </div>

                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required>
                    </div>

                    <div>
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label for="notification_switch">Notification Switch</label>
                        <input type="checkbox" id="notification_switch" name="notification_switch" {{ $user->notification_switch ? 'checked' : '' }}>
                    </div>

                    <button type="submit">Update Profile</button>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
