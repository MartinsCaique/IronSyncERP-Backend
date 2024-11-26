<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAuthenticatedWithToken
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar se o usuário está autenticado via Sanctum
        if (!Auth::guard('sanctum')->check()) {
            return response()->json(['error' => 'Acesso negado. Autenticação requerida.'], 401);
        }

        return $next($request);
    }
}
