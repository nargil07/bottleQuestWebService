<?php

namespace RoadBottle\Http\Middleware;

use Carbon\Carbon;
use Closure;

class GoogleRequestMiddleware
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
        if($request->has('google_token')){
            $client = new \Google_Client(['client_id' => '212807446617-24f47oo4h6bu4l976dun8qi1dtqq3n4k.apps.googleusercontent.com']);

            $payload = $client->verifyIdToken($request->google_token);
            if ($payload) {
                $request->attributes->set('payload', $payload);
            } else {
                // Invalid ID token
            }
        }

        return $next($request);
    }
}
