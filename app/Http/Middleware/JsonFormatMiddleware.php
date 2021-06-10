<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class JsonFormatMiddleware
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
        $response = $next($request);
        if($request->ajax()){
            try{
                return response()->json([
                    'data' => $response,
                ]);
            }catch (HttpException $httpException){
                return response()->json([
                    'errorCode' => $httpException->getCode(),
                    'msg' => $httpException->getMessage(),
                    'trace' => env("APP_DEBUG") === true ? $httpException->getTrace() : null,
                    'error' => true,
                ], $httpException->getStatusCode());
            }catch (\Exception $exception){
                return response()->json([
                    'errorCode' => $exception->getCode(),
                    'msg' => $exception->getMessage(),
                    'trace' => env("APP_DEBUG") === true ? $exception->getTrace() : null,
                    'error' => true,
                ], 503);
            }
        }
        return $response;
    }
}
