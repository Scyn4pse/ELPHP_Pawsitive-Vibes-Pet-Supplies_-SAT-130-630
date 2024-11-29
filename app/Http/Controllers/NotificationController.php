<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    // Display a listing of the notifications
     // Display a listing of notifications
     public function getAllNotifications()
     {
         $notifications = Notification::all();  // Fetch all notifications from the database
         return response()->json($notifications);
     }
 
     // Store a newly created notification
     public function createNotifications(Request $request)
     {
         // Validate incoming request data
         $validator = Validator::make($request->all(), [
             'user_id' => 'required|exists:users,id', // Make sure user exists in the users table
             'notif_user_type' => 'required|integer',
             'notif_message' => 'required|string|max:225',
             'notif_is_read' => 'required|boolean',
         ]);
 
         // Return validation errors if validation fails
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 400);
         }
 
         // Create a new notification in the database
         $notification = Notification::create($request->only(['user_id', 'notif_user_type', 'notif_message', 'notif_is_read']));
 
         // Return the created notification as a JSON response
         return response()->json($notification, 201);
     }
 
     // Display the specified notification
     public function getNotification($id)
     {
         // Find notification by ID or fail
         $notification = Notification::findOrFail($id);  
         return response()->json($notification);
     }
 
     // Update the specified notification
     public function updateNotification(Request $request, $id)
     {
         // Find notification by ID or fail
         $notification = Notification::findOrFail($id);  
 
         // Validate incoming request data
         $validator = Validator::make($request->all(), [
             'user_id' => 'sometimes|required|exists:users,id', 
             'notif_user_type' => 'sometimes|required|integer',
             'notif_message' => 'sometimes|required|string|max:225',
             'notif_is_read' => 'sometimes|required|boolean',
         ]);
 
         // Return validation errors if validation fails
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 400);
         }
 
         // Update the notification with validated data
         $notification->update($request->only(['user_id', 'notif_user_type', 'notif_message', 'notif_is_read']));
 
         return response()->json($notification);
     }
 
     // Remove the specified notification
     public function deleteNotification($id)
     {
         // Find notification by ID or fail
         $notification = Notification::findOrFail($id);  
         $notification->delete();  // Delete the notification from the database
         return response()->json(null, 204);  // Return a success response with no content
     }
}
