<?php

namespace App\Repositories\Bnet;


use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Cache;

class MetadataRepository
{

    protected static $endpoint = 'https://us.api.blizzard.com/hearthstone/metadata';
    protected static $helper;

    public function __construct()
    {
        self::$helper = new CommonHelper();
    }

    public static function findByType($type)
    {
        self::$endpoint .= '/' . $type . '?locale=en_GB&access_token=' . Cache::get('BnetToken');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', Cache::get('BnetToken')));
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

    public static function all()
    {
        self::$endpoint .= '?locale=en_GB&access_token=' . Cache::get('BnetToken');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', Cache::get('BnetToken')));
        curl_setopt($ch, CURLOPT_URL,  self::$endpoint);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }
}
