<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCadastro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null)
        {
            return redirect('cadastroUsuario');
        }
        return $next($request);
    }
}
