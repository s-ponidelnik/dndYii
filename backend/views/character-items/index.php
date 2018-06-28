<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacterItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Character Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Character Items'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $characters = \common\models\Character::find()->all();
    foreach ($characters as $character) {
        print '<h1><a href="http://backend.dnd/index.php?r=character-items%2Fitems&id='.$character->id.'" target="_blank">'.$character->name.'</a></h1>';
    }
    ?>
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
                'attribute' => 'item_id',
                'value' => function ($data) {
                    return $data->item->_name.'#'.$data->id;
                }
            ],
            'count',
            'equip',
            'item.weight',
            [
                'attribute' => 'cost',
                'value' => function ($data) {
                    if (empty($data->item->currency_type_id))
                        return '-';
                    return $data->item->cost . ' ' . $data->item->currencyType->_short_name;
                }
            ],
            [
                'attribute' => 'in_item',
                'value' => function ($data) {
                    if (is_object($data->parent))
                        return $data->parent->item->name.'#'.$data->parent->id;
                    else
                        return '-';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
