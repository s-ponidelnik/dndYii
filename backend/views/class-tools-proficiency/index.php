<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClassToolsProficiencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Class Tools Proficiencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-tools-proficiency-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Class Tools Proficiency'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a(Yii::t('app', 'Create Class Tools Proficiency for tools type'), ['create-sub'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'class_id',
                'value' => function ($data) {
                    return $data->class->_name;
                }
            ],
            'count',
            [
                'attribute' => 'tools_object_id',
                'value' => function ($data) {
                    return $data->toolsObject->_name;
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
