<?php

namespace App\Models;

use App\Helpers\CommonHelper;
use Illuminate\Database\Eloquent\Model;

class Deck
{

    protected static $endpoint = 'https://us.api.blizzard.com/hearthstone/deck';
    protected static $helper;


    public function __construct()
    {
        self::$helper = new CommonHelper();
    }


    public static function find()
    {
        self::$endpoint .= '/?locale=en_GB&access_token=' . env('BATTLENET_ACCESS_TOKEN');

        if (!request()->empty) {
            self::$endpoint .=  self::$helper->filters(request()->all());
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', env('BATTLENET_ACCESS_TOKEN')));
        curl_setopt($ch, CURLOPT_URL,  self::$endpoint);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($error = self::$helper->show_error(curl_getinfo($ch, CURLINFO_HTTP_CODE))) {
            return $error;
        }

        return json_decode($response);
    }
}
