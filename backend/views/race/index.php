<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Races');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Race'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                'id',
            [
                'attribute' => 'name',
                'format' => 'text',
                'content' => function ($data) {
                    return $data->_name;
                },
            ],
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    if (empty($data->parent_id))
                        return '-';
                    return $data->parent->_name;
                }
            ],
            [
                'attribute' => 'sub_race',
                'label' => Yii::t('app', 'Sub Race'),
                'format' => 'text',
                'content' => function ($data) {
                    return ($data->parent_id > 0) ? '+' : '';
                },
            ],
            [
                'attribute' => 'playable',
                'label' => Yii::t('app', 'Playable'),
                'format' => 'text',
                'content' => function ($data) {
                    return ($data->playable) ? Yii::t('app', 'Yes') : Yii::t('app', 'No');
                },
            ],
            [
                'attribute' => 'parent_id',
                'label' => Yii::t('app', 'Sub Race'),
                'format' => 'text',
                'content' => function ($data) {
                    return ($data->parent_id > 0) ? $data->parent->_name : '-';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
