<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$perfiles): Response
    {
        $user = Auth::user();

        if (!$user || !in_array($user->perfil, $perfiles)) {
            return response()->json([
                'error' => true,
                'message' => 'No tienes acceso a este panel'
            ], 403);
        }

        return $next($request);
    }
}
