<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::with('category')->get();

        return Inertia::render('Users', [
            'users' => $users,
        ]);
    }
}
