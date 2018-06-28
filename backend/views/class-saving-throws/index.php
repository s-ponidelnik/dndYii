<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClassSavingThrowsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Class Saving Throws');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-saving-throws-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Class Saving Throws'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'class_id',
                'label'=>Yii::t('app','Class'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->class->name;
                },
                'filter' => \common\models\_Class::getAllList()
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
