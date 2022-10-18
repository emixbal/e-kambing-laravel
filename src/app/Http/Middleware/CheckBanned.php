<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(!Auth::user()->active){
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akun anda nonaktif. Silahkan kontak administrator');
            }
        }
        return $next($request);
    }
}
