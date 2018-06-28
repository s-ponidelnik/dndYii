<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClassMagicLevelPointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Class Magic Level Points');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-magic-level-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Class Magic Level Point by class'), ['class'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a(Yii::t('app', 'Create Class Magic Level Point'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'level',
            'spell_level',
            'spell_point',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);  ?>
    <?php Pjax::end(); ?>
</div>
