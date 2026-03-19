<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterService
{
    public function Register($data)
    {
        $exists = User::where('email', $data['email'])->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'email' => ['email alredy exist in system.'],
            ]);
        }
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => hash::make($data['password']),
        ]);

        return $user;
    }
}
