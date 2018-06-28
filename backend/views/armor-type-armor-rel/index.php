<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArmorTypeArmorRelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Armor Type Armor Rels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armor-type-armor-rel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Armor Type Armor Rel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'armor_id',
                'label'=>Yii::t('app','Armor'),
                'format' => 'text',
                'content' => function ($data) {
                    return $data->armor->_name;
                },
            ],
            [
                'attribute' => 'type_id',
                'label'=>Yii::t('app','Group'),
                'format' => 'text',
                'content' => function ($data) {
                    return $data->type->_name;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
