<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArmorTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Armor Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armor-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Armor Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            '_name',
            [
                'attribute' => 'don',
                'format' => 'text',
                'content' => function ($data) {
                    if (!empty($data->don))
                        return $data->don . ' ' . Yii::t('app', $data->donTimeTypeName);
                    return '-';
                },
            ], [
                'attribute' => 'doff',
                'format' => 'text',
                'content' => function ($data) {
                    if (!empty($data->doff))
                        return $data->doff . ' ' . Yii::t('app', $data->donTimeTypeName);
                    return '-';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
