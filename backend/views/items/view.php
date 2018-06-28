<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Items */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'item_type',
                'value' => function ($data) {
                    return $data->type;
                }
            ],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->_name;
                }
            ],
            [
                'attribute' => 'cost',
                'value' => function ($data) {
                    if (empty($data->currency_type_id))
                        return '-';
                    return $data->cost . ' ' . $data->currencyType->_short_name;
                }
            ],
            'weight',
            'packable',
            [
                'attribute' => 'short_description',
                'format' => 'html',
            ],
            [
                'attribute' => 'description',
                'format' => 'html',
            ]
        ],
    ]) ?>

</div>
