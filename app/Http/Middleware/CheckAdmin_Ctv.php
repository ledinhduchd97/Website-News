<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdmin_Ctv
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
        if(Auth::check())
            {
                $user = Auth::user();
                if($user->level == 2) 
                {
                    return redirect()->route('admin.index');
                }
                else if($user->level == 1)
                {
                   return redirect()->route('ctv.index');
                }
                else
                    return $next($request);
            }
        else
            return $next($request);
    }
}
