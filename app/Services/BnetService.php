<?php

namespace App\Services;

use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BnetService
{


    protected $helper;

    public function __construct()
    {
        $this->helper = new CommonHelper;
    }

    public function refreshToken()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,  "https://us.battle.net/oauth/token?grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, env('BATTLENET_CLIENT_ID') . ":" . env('BATTLENET_CLIENT_SECRET'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($error = $this->helper->show_error(curl_getinfo($ch, CURLINFO_HTTP_CODE))) {
            return $error;
        }

        $response = json_decode($response);

        Log::info('BnetService', ["message" => 'Bnet token response', 'response' => $response]);
        // Set token to cache
        Cache::set('BnetToken', $response->access_token, $response->expires_in);
        return $response;
    }
}
