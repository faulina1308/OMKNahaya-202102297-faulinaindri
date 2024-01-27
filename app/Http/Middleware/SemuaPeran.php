<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SemuaPeran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && ($user->jenis_kelamin === null || $user->alamat === null || $user->no_telepon === null || $user->tanggal_lahir === null)) {
            $request->session()->put('lengkapi_data', true);
            return redirect(RouteServiceProvider::LENGKAPI_DATA);
        }
        return $next($request);
    }
}
