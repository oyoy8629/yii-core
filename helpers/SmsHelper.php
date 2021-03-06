<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2016/4/24
 * Time: 23:53
 */

namespace app\helpers;


use app\api\yunpian\SmsOperator;
use app\models\CaptchaCode;

class SmsHelper
{

    public static function send($mobile)
    {
        $session = \yii::$app->session;
        $sessionKey = 'LIMIT_REQUEST';

        $sessionValue = $session->get($sessionKey);
        $sessionLimit = 5;

        $time = CURRENT_TIMESTAMP - $sessionValue;

        if (empty($sessionValue) || ($sessionValue && $time > $sessionLimit)) {
            $session->set($sessionKey, CURRENT_TIMESTAMP);

            $code = rand(10000, 99999);
            $sms = new SmsOperator();
            $content = '【网上游戏】您的验证码：' . $code . '';
            $send = $sms->single_send([
                'mobile'=>$mobile,
                'text'=>$content
            ]);
            if ($send->statusCode == 200){
                CaptchaCode::insertCode($mobile, $code, $content);
                return ['code'=>200, 'msg'=>'ok'];
            }
            return ['code'=>201, 'msg'=>'send failed'];
        } else {
            return ['code'=>202, 'msg'=>'请等待' . ($sessionLimit - $time) . '秒'];
        }
    }

    public static function sendRegSuccess($mobile,$username,$password){
        $sms = new SmsOperator();
        $content = '【网上游戏】成功注册！您的用户名为：'.$username.'，密码为：'.$password.'，官网：http://83222.net';
        return $sms->single_send([
            'mobile'=>$mobile,
            'text'=>$content
        ]);
    }


    public static function check($mobile, $code)
    {


        $model = CaptchaCode::find()->where([
            'mobile' => $mobile,
            'status' => 0
        ])->andWhere($and)->orderBy('created_at desc')->one();

        if (empty($model)) {
            return false;
        }
        if ($model->code != $code) {
            return false;
        }
        return $model;
    }


}
