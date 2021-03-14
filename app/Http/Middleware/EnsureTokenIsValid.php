<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class EnsureTokenIsValid
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

        $key = "djidjifisdidsisdeddcsww348332feUUGGyugtyrr33r6";

        $headers = getallheaders();
       
        $token= $headers['Authorization'];
        $splitted = explode(" ", $token);

       $decoded = JWT::decode($splitted[1], $key, array('HS256'));

        if ($decoded->rol== "administrador"){
                
                return $next($request);
        }else{
            abort(403, "Ud no es admin");
        }
        
    }
}
