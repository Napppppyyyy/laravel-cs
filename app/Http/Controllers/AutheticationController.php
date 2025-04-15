<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutheticationController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255'],
         ])

         $user = user::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
         ])

         return response()->json(['message' => 'user created successfully!', 'user' => $user]),

    }
}
