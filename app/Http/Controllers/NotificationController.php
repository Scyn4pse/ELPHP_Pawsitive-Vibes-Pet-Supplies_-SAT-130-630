<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
     public function getAllNotifications()
     {
         $notifications = Notification::all();  
         return response()->json($notifications);
     }
 
     public function createNotifications(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'user_id' => 'required|exists:Customers,id|Sellers,id', 
             'notif_user_type' => 'required|integer',
             'notif_message' => 'required|string|max:225',
             'notif_is_read' => 'required|boolean',
         ]);
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 400);
         }
 
         $notification = Notification::create($request->only(['user_id', 'notif_user_type', 'notif_message', 'notif_is_read']));
 
         return response()->json($notification, 201);
     }
 
     public function getNotification($id)
     {
         $notification = Notification::findOrFail($id);  
         return response()->json($notification);
     }
 
     public function updateNotification(Request $request, $id)
     {
         $notification = Notification::findOrFail($id);  
 
         $validator = Validator::make($request->all(), [
             'user_id' => 'sometimes|required|exists:Users,id', 
             'notif_user_type' => 'sometimes|required|integer',
             'notif_message' => 'sometimes|required|string|max:225',
             'notif_is_read' => 'sometimes|required|boolean',
         ]);
 
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 400);
         }
 
         $notification->update($request->only(['user_id', 'notif_user_type', 'notif_message', 'notif_is_read']));
 
         return response()->json($notification);
     }
 
     public function deleteNotification($id)
     {
         $notification = Notification::findOrFail($id);  
         $notification->delete();  
         return response()->json(null, 204);  
     }
}
