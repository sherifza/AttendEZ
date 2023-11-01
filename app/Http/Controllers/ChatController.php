<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('chat.index', [
            'users' => $users,
            'authUser' => auth()->user(),
        ]);
    }

    public function getMessages($fromUserId, $toUserId): JsonResponse
    {

        // Query the ChatMessage model to fetch messages between the two users
        $messages = Chat::where(function ($query) use ($fromUserId, $toUserId) {
            $query->where('from_user', $fromUserId)
                ->where('to_user', $toUserId);
        })->orWhere(function ($query) use ($fromUserId, $toUserId) {
            $query->where('from_user', $toUserId)
                ->where('to_user', $fromUserId);
        })->orderBy('sent_at', 'asc')->get();

        return response()->json($messages);
    }
    public function sendMessage(Request $request): JsonResponse
    {
        // Validate the request data
        $this->validate($request, [
            'message' => 'required|string',
            'to_user' => 'required|exists:users,id', // Ensure the recipient user exists
        ]);

        // Create a new chat message
        $chat = new Chat();
        $chat->from_user = auth()->user()->id; // Set the sender
        $chat->to_user = $request->input('to_user'); // Set the recipient
        $chat->message = $request->input('message');
        $chat->sent_at = now(); // Set the current timestamp

        // Save the chat message
        $chat->save();

        return response()->json(['message' => 'Chat message sent successfully']);
    }
}
