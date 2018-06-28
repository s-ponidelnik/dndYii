<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\_ClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Classes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Class'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            '_name',
            'archetype',
            'parent_id',
            'class_skill_proficiency',
            'caster_value',
            [
                'label' => Yii::t('app','Magician type'),
                'attribute' => 'magic_proficiency_type',
                'format' => 'text',
                'content' => function ($data) {
                    return $data->getMagicProficiencyTypeName();
                },
                'filter' => \common\models\_Class::magicProficiencyTypes()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
