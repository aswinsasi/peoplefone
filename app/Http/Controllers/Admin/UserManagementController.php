<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();

         // Loop through the users and check if each user is being impersonated
         $users->each(function ($user) {
            $user->isImpersonating = ($user->id === Session::get('admin_id'));
        });

        return view('admin.user-management', compact('users'));
    }
}
