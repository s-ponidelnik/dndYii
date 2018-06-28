<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RaceAbilityModifierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Race Ability Modifiers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-ability-modifier-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Race Ability Modifier'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute'=>'ability_id',
                'label'=>Yii::t('app','Ability'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->ability->name.'('.$data->ability->nameID.')';
                },
                'filter' => \common\models\Ability::getAllList()
            ],
            [
                'attribute'=>'modifier',
                'label'=>Yii::t('app','Modifier'),
                'format'=>'text',
                'content'=>function($data){
                    return ($data->modifier>0) ? '+'.$data->modifier : $data->modifier;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],'summary'=>'',
    ]); ?>
    <?php Pjax::end(); ?>
</div>
