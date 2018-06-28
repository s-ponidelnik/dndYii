<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TalentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Talents/Features');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talent-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Talent/Feature'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    if (!empty($data->property))
                        return $data->_name . '(' . $data->property . ')';
                    return $data->_name;
                }
            ],
            [
                'attribute' => 'description',
                'format' => 'html',
                'contentOptions' => ['style' => 'width:600%; white-space: normal;'],
            ],
            'count',
            'rest_type',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
