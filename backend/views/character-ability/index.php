<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacterAbilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Character Abilities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-ability-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Character Ability'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'character_id',
                'value' => function ($data) {
                    return $data->character->name;
                }
            ],
            [
                'attribute' => 'ability_id',
                'value' => function ($data) {
                    return $data->ability->_name;
                }
            ],
            'value',
            [
                'attribute' => 'modifier',
                'value'=>function($data){
                    return $data->characterModifier_string;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
