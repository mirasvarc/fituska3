<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserCanModerate
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

        if (!User::where('id', auth()->user()->id)->first()->canModerate()) {
            return redirect('home');
        }

        return $next($request);
    }
}
