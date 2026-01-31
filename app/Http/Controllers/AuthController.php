<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'username' => 'required|string|max:255|unique:users,username',
      'email' => 'required|string|email|max:255|unique:users,email',
      'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'message' => 'Sukses registrasi',
      'token' => $token,
      'user' => ['name' => $user->name, 'email' => $user->email],
    ], 201);
  }

  public function login(Request $request)
  {
    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json([
        'message' => 'User atau password salah. Silahkan coba lagi!',
      ], Response::HTTP_UNAUTHORIZED);
    }

    $user = Auth::user();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'message' => 'Sukses login',
      'user' => ['name' => $user->name, 'email' => $user->email],
      'token' => $token,
    ], 200);
  }
}
