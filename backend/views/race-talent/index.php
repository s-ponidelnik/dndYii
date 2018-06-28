<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RaceTalentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Race Talents/Features');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-talent-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Race Talent/Feature'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'race_id',
                'label'=>Yii::t('app','Race'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->race->name;
                },
                'filter' => \common\models\Race::getAllList()
            ],
            [
                'attribute'=>'talent_id',
                'label'=>Yii::t('app','Talent/Feature'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->talent->name;
                },
                'filter' => \common\models\Talent::getAllList()
            ],
            [
                'label'=>Yii::t('app','Description'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->talent->description;
                },
                'contentOptions' => ['style' => 'width:300px; white-space: normal;'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
