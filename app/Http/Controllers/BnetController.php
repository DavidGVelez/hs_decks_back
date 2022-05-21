<?php

namespace App\Http\Controllers;

use App\Services\BnetService;
use Exception;
use Illuminate\Support\Facades\Log;

class BnetController extends Controller
{

    protected $bnetService;

    public function __construct(BnetService $bnetService)
    {
        $this->bnetService = $bnetService;
    }


    public function refresh_access_token()
    {
        try {
            Log::info('BnetController', ['message' => 'Trying to get token']);
            // Refresh token
            $this->bnetService->refreshToken();

            return response()->setStatusCode('200');
        } catch (Exception $e) {
            Log::error('BnetController', ['message' => 'Error retrieving Bnet token', 'error' => $e]);
            return response()->setStatusCode('400');
        }
    }
}
