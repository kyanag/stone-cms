<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AjaxMiddleware
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
//        if($request->ajax()){
//            $response = $next($request);
//            return $this->transformResponse($response);
//        }
        return $next($request);
    }
}
