<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Tambahkan logic untuk check admin role jika diperlukan
        // if (!auth()->user()->is_admin) {
        //     abort(403);
        // }

        return $next($request);
    }
}
