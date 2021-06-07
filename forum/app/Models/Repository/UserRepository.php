<?php

namespace App\Models\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @param Request $request
     */
    public function create(Request $request): User
    {
        //Insert Into Database
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
