<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Repository\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Register new user
     * @method Post
     * @param Request $request
     */
    public function register(Request $request)
    {
        //Validate parameters
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        // resolve function created object with UserRepository
        $user = resolve(UserRepository::class)->create($request);
        $defaultSuperAdminEmail = config('permission.default_super_admin_email');

        if ($user->email === $defaultSuperAdminEmail) {
            $user->assignRole('super_admin');
        } else {
            $user->assignRole('user');
        }

        return response()->json([
            'message' => 'create successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Login User
     * @Method POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(Auth::user());
        }

        return response()->json([
            'message' => 'login failed'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function user()
    {
        return response()->json(Auth::user());
    }

    /**
     * logout User
     */
    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'user logged out successfully'
        ],Response::HTTP_OK);
    }
}
