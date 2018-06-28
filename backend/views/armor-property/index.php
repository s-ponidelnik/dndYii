<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArmorPropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Armor Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armor-property-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Armor Property'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'item_id',
                'value' => function ($data) {
                    return $data->item->_name;
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return \common\models\ArmorType::getTypeList()[$data->type_id];
                }
            ],
            'ac',
            'str',
            [
                'attribute' => 'stealth_disadvantage',
                'value' => function ($data) {
                    return ($data->stealth_disadvantage) ? Yii::t('app', 'Yes') : Yii::t('app', 'No');
                }
            ],
            'dex_mod',
            'dex_mod_limit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
