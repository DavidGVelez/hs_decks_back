<?php

namespace App\Http\Controllers;

use App\Helpers\QueryHelper;
use Illuminate\Http\Request;

class BnetController extends Controller
{

    protected $helper;

    public function __construct()
    {
        $this->helper = new QueryHelper;
    }

    public function refresh_access_token()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,  "https://us.battle.net/oauth/token?grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, env('BATTLENET_CLIENT_ID') . ":" . env('BATTLENET_CLIENT_SECRET'));

        // curl_setopt($ch, CURLOPT_POSTFIELDS, ['_token' => csrf_token()]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($error = $this->helper->show_error(curl_getinfo($ch, CURLINFO_HTTP_CODE))) {
            return $error;
        }

        return json_decode($response);
    }
}
