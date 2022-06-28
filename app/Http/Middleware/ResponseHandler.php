<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Обработчик ответов
 */
class ResponseHandler
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Принудительно выставляет формат ответа как JSON
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
