<?php

namespace App\Http\Middleware;

use Closure;

class SessionTrue
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
      if ($request->session()->has('aktif')) {
        return redirect('/');
      } else {
        return $next($request);
      }
    }
}
