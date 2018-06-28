<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tools');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tools'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->_name;
                }
            ],
            [
                'attribute' => 'cost',
                'value' => function ($data) {
                    return $data->cost . ' ' . $data->currencyType->_short_name;
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return empty($data->type_id) ? '-' : $data->type->_name;
                }
            ],
            'weight',
            [
                'contentOptions' => ['style' => 'width:200px; white-space: normal;'],
                'attribute' => 'short_desc',
                'format'=>'html',
                'value' => function ($data) {
                    return $data->getFullShortDesc();
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Tools'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::end(); ?>
</div>
