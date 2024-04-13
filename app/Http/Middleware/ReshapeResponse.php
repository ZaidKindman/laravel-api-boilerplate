<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReshapeResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $content = $response->getContent();
        $reshapedContent = null;

        if ($response->getStatusCode() == 200)
            $reshapedContent = json_encode(['data' => json_decode($content), 'status' => 'success', 'message' => null]);
        else if ($response->getStatusCode() == 404)
            $reshapedContent = json_encode(['data' => null, 'status' => 'not found', 'message' => 'Object Not Found']);
        else if ($response->getStatusCode() == 422) {
            $reshapedContent = json_encode(['data' => json_decode($content)->errors, 'status' => 'bad request', 'message' => json_decode($content)->message]);
            $response->setStatusCode(400);
        } else
            $reshapedContent = $content;


        $response->setContent($reshapedContent);
        return $response;
    }
}
