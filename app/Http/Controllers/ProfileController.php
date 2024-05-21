<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show($userId)
    {
        $user = User::find($userId);
        return view('profile.show', compact('user'));
    }
}
