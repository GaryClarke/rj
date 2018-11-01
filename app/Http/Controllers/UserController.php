<?php

namespace App\Http\Controllers;

use App\Notification;

class UserController extends Controller {

    public function update()
    {
        $this->validate(request(), [
            'profile_picture' => 'image'
        ]);

        // Store the file
        $file = request()->file('profile_picture');

        $path = $file->storeAs('public', auth()->id() . '.' . $file->extension());

        // Add the path to the user record
        auth()->user()->update([
           'profile_picture' => $path
        ]);

        // Notify admin
        Notification::create([
            'text' => 'User ' . auth()->id() . ' has uploaded a new profile picture'
        ]);

        return back();
    }
}