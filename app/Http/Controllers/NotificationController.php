<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Méthode pour afficher les notifications
    }

    public function markAsRead($id = null)
    {
        if ($id) {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();
        } else {
            auth()->user()->unreadNotifications->markAsRead();
        }
        
        return response()->json(['success' => true]);
    }
}