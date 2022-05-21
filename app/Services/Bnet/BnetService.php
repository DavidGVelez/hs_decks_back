<?php

namespace App\Services\Bnet;

use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Repositories\Bnet\BnetRepository;
use Throwable;

class BnetService
{

    protected $bnetRepository;

    public function __construct(BnetRepository $bnetRepository)
    {
        $this->bnetRepository = $bnetRepository;
    }

    public function refreshToken()
    {
        try {
            Log::info('BnetService', ['Refreshing Bnet Token']);
            $token = $this->bnetRepository->refreshToken();
            // Set token to cache
            Cache::set('BnetToken', $token->access_token, $token->expires_in);
        } catch (Throwable $e) {
            Log::error('BnetService' . [$e]);
        }
    }

    public function getToken()
    {
        if (Cache::has('BnetToken')) {
            return Cache::get('BnetToken');
        }
        // Refresh access token
        try {
            $token = $this->refreshToken();
            return $token;
        } catch (Throwable $e) {
            Log::error('BnetService' . ['message' => 'Error getting bnet token', 'error' => $e]);
        }
    }
}
