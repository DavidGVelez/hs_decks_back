<?php

namespace App\Http\Middleware;

use App\Services\BnetService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
        if (!Cache::has('BnetToken')) {
            try {
                Log::info('Refreshing Bnet Token');
                $this->bnetService->refreshToken();
            } catch (Throwable $e) {
                return response('Token error', 500);
            }
        }
        return $next($request);
    }
}
