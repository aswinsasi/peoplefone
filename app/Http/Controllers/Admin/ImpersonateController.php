<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ImpersonateController extends Controller
{
    public function impersonate(Request $request, User $user)
    { 
        // Verify if the authenticated user is an admin
        if (!auth()->guard('admin')->user()) {
            abort(403, 'Unauthorized');
        }

        // Store the admin's ID in the session
        Session::put('admin_id', Auth::id());

        // Log in as the user with the provided ID
        Auth::loginUsingId($user->id);

        $user = auth()->user();

        $currentDateTime = Carbon::now();

        $unreadNotificationCount = $user->unreadNotificationCount();
        $notifications = $user->notifications()->where('expiration', '>', $currentDateTime)->get();

        return view('home', [
            'user' => $user,
            'unreadNotificationCount' => $unreadNotificationCount,
            'notifications' => $notifications
        ]);

         // Pass the user data and impersonation status to the view
        return view('home', [
            'user' => $user,
            'isImpersonating' => 1,
        ]);
    }

    public function stopImpersonating(Request $request)
    { 
        // Verify if the authenticated user is an admin
        if (!auth()->guard('admin')->user()) {
            abort(403, 'Unauthorized');
        }

        // Log in as the admin using the stored admin ID
        Auth::loginUsingId(Session::pull('admin_id'));

        return redirect()->route('admin.dashboard');
    }
}
