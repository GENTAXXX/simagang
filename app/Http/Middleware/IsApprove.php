<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsApprove
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $mhs = Mahasiswa::where('user_id', Auth::id())->first();
        if ($mhs->status_id == '2'){
            return $next($request);
        }else{
            return redirect()->route('redirect');
        }
    }
}
