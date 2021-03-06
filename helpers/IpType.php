<?php
/**
 * Created by PhpStorm.
 * User: oba
 * Date: 2016/2/3
 * Time: 23:38
 */

namespace app\helpers;

use Curl\Curl;

class IpType
{
    static $type = [
        1=>'数据中心',
        2=>'专用出口',
        3=>'普通宽带',
        4=>'移动宽带',
        5=>'路由节点'
    ];
    public static function ip($ip){
        $url = 'http://apis.baidu.com/rtbasia/ip_type/ip_type?ip='.$ip;
        $curl = new Curl();
        $curl->setHeader("apikey","58d0d55af6ee8cda005ec2d674ff0db2");
        $curl->get($url);
        $curl->close();

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage;
        } else {
            return $curl->response;
        }
    }
//    public static function find($ip){
//        $data = static::ip($ip);
//        $data = json_decode($data,true);
//
//        if(!isset($data['code']) ||  $data['code'] != 200 ){
//            return false;
//        }
//        return in_array($data['data']['type'],array_keys(static::$type)) ? static::$type[$data['data']['type']] : "未知";
//    }

    public static function find($ip){
        $data = static::ip($ip);
        $data = json_decode($data,true);

        if(!isset($data['code']) ||  $data['code'] != 200 ){
            return false;
        }
        return in_array($data['data']['type'],array_keys(static::$type)) ? $data['data']['type'] : -1;
    }

}
