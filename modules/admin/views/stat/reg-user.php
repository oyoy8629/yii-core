<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use \app\helpers\Column;



/* @var $this yii\web\View */
/* @var $searchModel app\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="brand-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => \app\helpers\StatColumns::getRegUserColumns(),
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'export' => [
            'fontAwesome' => true,
            'target' =>'_blank'
        ],
        'toggleData'=>false,
        'condensed' => true,
        'hover' => true,
        'panel' => [
            'heading' => '',
            'type' => GridView::TYPE_SUCCESS,
            'before' => $this->render('../search/common_search',[
                'model'=>$model
            ]),
            'after' => false
        ],
    ]); ?>

</div>
