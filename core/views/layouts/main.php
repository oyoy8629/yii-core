<?php
/**
 * @author oba.ou
 */
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
app\core\assets\CoreAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> sidebar-mini control-sidebar-open">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('header') ?>
    <?= $this->render('left')?>
    <?= $this->render(
        'content',
        ['content' => $content,'box'=>false]
    ) ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
