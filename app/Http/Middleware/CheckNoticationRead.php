<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNoticationRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notify')){
            $notication=auth()->user()->unreadNotifications()->where('id',$request->query('notify'))->first();
            if($notication) {
                $notication->markAsRead();
            }
    
        }
        return $next($request);
    }
}
