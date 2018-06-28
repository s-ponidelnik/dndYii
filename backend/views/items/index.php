<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'item_type',
                'value' => function ($data) {
                    return $data->type;
                }
            ],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->_name;
                }
            ],
            [
                'attribute' => 'cost',
                'value' => function ($data) {
                    if (empty($data->currency_type_id))
                        return '-';
                    return $data->cost . ' ' . $data->currencyType->_short_name;
                }
            ],
            'weight',
            'packable',
            [
                'contentOptions' => ['style' => 'width:200px; white-space: normal;'],
                'attribute' => 'short_description',
                'format'=>'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
