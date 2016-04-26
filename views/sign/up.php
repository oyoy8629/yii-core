<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApiUser */

$this->title = Yii::t('app', 'Create') . Yii::t('app', 'Api User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Api Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-user-create box box-danger">
    <?php $form = ActiveForm::begin(); ?>
    <div class="api-user-form box-body">

        <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'smsCode')->widget(\app\core\widgets\VerifySms::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{input}</div><div class="col-lg-6">{button}</div></div>',
        ]) ?>

        <?= $form->field($model, 'UserName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'TrueName')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'ReferralCode')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>


    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn
    btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
