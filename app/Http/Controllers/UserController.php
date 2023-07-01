<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->notification_switch = $request->has('notification_switch');

        // Additional fields and validation as per your user model

        $user->save();

        return redirect()->back();
    }
}
