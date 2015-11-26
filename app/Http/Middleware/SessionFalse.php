<?php

namespace App\Http\Middleware;

use Closure;

class SessionFalse
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
        return $next($request);
      } else {
        return redirect('/masuk');
      }

    }
}
