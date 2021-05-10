<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserIsValidated
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

        if (!User::where('id', auth()->user()->id)->first()->isValidated()) {
            Auth::logout();
            return redirect('login');
        }

        return $next($request);
    }
}
