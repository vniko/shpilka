<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class Cors {

    public function handle($request, Closure $next)
    {



        if ($request->getMethod() === 'OPTIONS') {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', '*');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Cache-Control, Origin');

            return $response;
        }

        // header("Access-Control-Allow-Origin: *");

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Cache-Control, Origin');
        return $response;
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//            ->header('Access-Control-Allow-Headers', 'Content-Type, Cache-Control, Origin');
    }
}