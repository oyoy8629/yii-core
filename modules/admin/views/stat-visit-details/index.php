<?php

use kartik\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatVisitDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '访问详情';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stat-visit-details-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'viewRefererUrl',
                'format'=>'raw'
            ],
            'current_url',
            'referer_keyword',
            'createdAt',
//             'updated_at',
        ],
        'pjax' => true,
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'export' => false,
        'condensed' => true,
        'hover' => true,
        'panel' => [
            'heading' => 'cookie:'.$idvisitor,
            'type' => GridView::TYPE_SUCCESS,
            'before' => false,
            'after' => false,
        ],
    ]); ?>

</div>
