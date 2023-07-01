@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('LOGIN') }}</div>

                <div class="card-body">

                    <!-- resources/views/auth/admin-login.blade.php -->
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required autofocus>
                        </div>

                        <div>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div>
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember Me</label>
                        </div>

                        <button type="submit">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection