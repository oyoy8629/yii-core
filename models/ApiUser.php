<?php

namespace app\models;

use app\helpers\Mobile;
use app\helpers\SignLogic;
use app\helpers\SmsHelper;
use Yii;
use \app\core\models\Model;
use \yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%api_user}}".
 *
 * @property string $id
 * @property string $UserName
 * @property string $Password
 * @property string $TrueName
 * @property string $Phone
 * @property string $ReferralCode
 * @property string $Email
 * @property integer $created_at
 * @property integer $updated_at
 */
class ApiUser extends Model
{
    public $Code;
    public $smsCode;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%api_user}}';
    }

    /*
     * 更新时间
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Phone','UserName','Password', 'smsCode'], 'required'],
            [['created_at', 'updated_at','ip'], 'safe'],
            [['UserName', 'Password', 'TrueName', 'ReferralCode', 'Email'], 'string', 'max' => 255],
            ['ReferralCode','default','value'=>'A000355'],
            ['ip','default','value'=>\app\stat\IP::getIpFromHeader()],
            [['Phone'], 'validatePhone'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'UserName' => '用户名',
            'Password' => '密码',
            'TrueName' => '真实名称',
            'verifyCode' => '验证码',
            'smsCode' => '验证码',
            'Phone' => '手机号码',
            'ReferralCode' => '推荐码',
            'Email' => '邮箱',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public $checkModel;

    public function validateSmsCode($attribute, $params)
    {
        $this->checkModel = CaptchaCode::find()->where([
            'mobile' => $this->Phone,
            'status' => 0
        ])->orderBy('created_at desc')->one();

        if (!$this->checkModel) {
            $this->addError('smsCode', '短信验证码错误1');
            return false;
        }
        if ($this->checkModel->code != $this->smsCode) {
            $this->addError('smsCode', '短信验证码错误2');
            return false;
        }
        if (CURRENT_TIMESTAMP - $this->checkModel->created_at > 600) {
            $this->addError('smsCode', '验证码已经过期');
            return false;
        }
        return true;
    }

    public function validatePhone($attribute, $params)
    {
        $model = new ApiUser();
        $model = $model->find()->where([
            'Phone'=>$this->Phone
        ])->one();

        if($model){
            $this->addError('Phone', '该手机号已经注册');
            return false;
        }
        $check = Mobile::check($this->Phone);
        if (!$check) {
            $this->addError('Phone', '请输入正确手机号');
            return false;
        }
        $this->checkModel = CaptchaCode::find()->where([
            'mobile' => $this->Phone,
            'status' => 0
        ])->orderBy('created_at desc')->one();
        if (!$this->checkModel) {
            $this->addError('smsCode', '短信验证码错误1');
            return false;
        }
        if ($this->checkModel->code != $this->smsCode) {
            $this->addError('smsCode', '短信验证码错误2');
            return false;
        }
        if (CURRENT_TIMESTAMP - $this->checkModel->created_at > 600) {
            $this->addError('smsCode', '验证码已经过期');
            return false;
        }
        return true;
    }


    public function beforeSave($insert)
    {
        $logic = new SignLogic();
        $return = $logic->signUp($this->attributes, 1);
        if ($return['code'] != 200) {
            $this->addError('UserName', $return['msg']);
            return false;
        }
        return parent::beforeSave($insert);
        // TODO: Change the autogenerated stub
    }

    public function ApiSignUp()
    {

    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->checkModel->status = 1;
        $this->checkModel->save();
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
