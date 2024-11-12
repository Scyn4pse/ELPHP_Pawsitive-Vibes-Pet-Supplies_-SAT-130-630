<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $notifications = Notification::all();  // Fetch all notifications from the database
        return response()->json($notifications);
    }

    // Store a newly created notification
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id', // Make sure user exists in the users table
            'notif_user_type' => 'required|integer',
            'notif_message' => 'required|string|max:225',
            'notif_is_read' => 'required|boolean',
        ]);

        // Create a new notification in the database
        $notification = Notification::create($request->all());

        // Return the created notification as a JSON response
        return response()->json($notification, 201);
    }

    // Display the specified notification
    public function show($id)
    {
        $notification = Notification::findOrFail($id);  // Find notification by ID
        return response()->json($notification);
    }

    // Update the specified notification
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);  // Find notification by ID

        // Validate and update notification data
        $notification->update($request->all());

        return response()->json($notification);
    }

    // Remove the specified notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);  // Find notification by ID
        $notification->delete();  // Delete the notification from the database
        return response()->json(null, 204);  // Return a success response with no content
    }
}
