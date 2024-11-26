<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login do administrador
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin) { // Certifique-se de que há uma coluna 'is_admin' no modelo User
                return response()->json([
                    'message' => 'Login bem-sucedido!',
                    'user' => $user,
                    'token' => $user->createToken('admin-token')->plainTextToken,
                ]);
            } else {
                return response()->json(['error' => 'Acesso negado.'], 403);
            }
        }

        return response()->json(['error' => 'Credenciais inválidas.'], 401);
    }

    // Logout
    public function logoutAdmin(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso!']);
    }
}
