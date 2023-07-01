<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index()
    {
        $currentDateTime = Carbon::now();
        
        if(auth()->user()->notification_switch ==1 ) {
            $notifications = Notification::where('expiration', '>', $currentDateTime)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $notifications = collect();
        }
        

        return view('notifications.index', compact('notifications'));
    }

    public function update(Notification $notification)
    {
        $notification->is_read = true;
        $notification->save();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }
    public function sendNotification(Request $request)
    {
        $notificationType = $request->input('type');
        $message = $request->input('message');
        $expiration = $request->input('expiration');
        $destination = $request->input('destination');

        if ($destination === 'all') {
            $users = User::all();

            foreach ($users as $user) {
                $notification = new Notification([
                    'user_id' => $user->id,
                    'type' => $notificationType,
                    'message' => $message,
                    'expiration' => $expiration,
                    'is_read' => false,
                ]);

                $notification->save();
            }
        } elseif ($destination === 'single') {
            $userId = $request->input('user_id');
            $user = User::findOrFail($userId);

            $notification = new Notification([
                'user_id' => $user->id,
                'type' => $notificationType,
                'message' => $message,
                'expiration' => $expiration,
                'is_read' => false,
            ]);

            $notification->save();
        }

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    public function create()
    {
        $users = User::all();
        return view('admin.create-notification', ['users' => $users]);
    }
}
