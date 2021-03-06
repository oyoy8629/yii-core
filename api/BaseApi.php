<?php

/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2016/4/20
 * Time: 22:34
 */
namespace app\api;

use \Curl\Curl;

class BaseApi extends \yii\base\Object
{


    const STAT_API_URL = 'http://p.sasa8.com/index.php';
    const STAT_API_TOKEN = 'c38de7c5e14711949af48b11464d8cba';
    public $params = [];
    public static $default = [
        'module' => 'API',
        'token_auth' => self::STAT_API_TOKEN,
        'format' => 'JSON',
        'expanded' => true,
        'idSite' => 1,
    ];



    public function run($params)
    {
        $params = array_merge(self::$default,$params);
        $curl = new Curl();
        $curl->setJsonDecoder(function ($response) {
            $json_obj = json_decode($response, true);
            if (!($json_obj === null)) {
                $response = $json_obj;
            }
            return $response;
        });

        $curl->get(self::STAT_API_URL, $params);
        $curl->close();

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage;
        } else {
            return $curl->response;
        }
    }
}