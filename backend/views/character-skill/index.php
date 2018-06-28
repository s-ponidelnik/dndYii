<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacterSkillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Character Skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-skill-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Character Skill'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'skill_id',
                'value' => function ($data) {
                    return $data->skill->_name;
                }
            ],
            [
                'attribute' => 'proficiency',
                'value' => function ($data) {
                    return ($data->proficiency) ? '+' : '';
                }
            ],
            [
                'attribute' => 'expertise',
                'value' => function ($data) {
                    return ($data->expertise) ? '+' : '';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
