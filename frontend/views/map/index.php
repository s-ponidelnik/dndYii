<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\sortable\Sortable;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Maps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Map'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?=\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_map',
    ]);?>

   <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'image',
                'format'=>'raw',
                'value'=>function ($model) {return Html::img(Yii::$app->params['uploadsUrl'].'/'.$model->img_name,['style'=>['max-width'=>'100px']]);}
            ],
            'type',
            'owner_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>-->
    <?php Pjax::end(); ?>
</div>
