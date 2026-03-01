<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompletedRentalOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403);
        }

        $hasCompletedRental = $user->rentals()->where("status","completed")->exists();

        if(!$hasCompletedRental) {
            abort(403,'You must complete a rental to access the community page');
        }
        
        return $next($request);
    }
}
