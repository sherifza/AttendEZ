<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users', compact('users'));
    }

    public function changeChatStatus(Request $request)
    {
        // Validate the request data if needed
        // Update the chat_status for the authenticated user
        $user = Auth::user();
        dump($request->input('chat_status'));
        dump($user->chat_status);

        $user->chat_status = $request->input('chat_status');
        $user->save();

    }

}
