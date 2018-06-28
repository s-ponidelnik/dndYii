<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RaceSkillProficiencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Race Skill Proficiencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-skill-proficiency-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Race Skill Proficiency'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'skill_id',
                'label'=>Yii::t('app','Skill'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->skill->name;
                },
                'filter' => \common\models\Skill::getAllList()
            ],
            [
                'attribute'=>'race_id',
                'label'=>Yii::t('app','Race'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->race->name;
                },
                'filter' => \common\models\Race::getAllList()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
