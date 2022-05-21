<?php

namespace App\Http\Middleware;

use App\Services\Bnet\BnetService;
use Closure;
use Illuminate\Http\Request;
use Throwable;

class BnetMiddleware
{

    protected $bnetService;

    public function __construct(BnetService $bnetService)
    {
        $this->bnetService = $bnetService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->bnetService->getToken();
            return $next($request);
        } catch (Throwable $e) {
            return response('Token error', 500);
        }
    }
}
