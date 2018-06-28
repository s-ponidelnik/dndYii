<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tools */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-view">

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
    <p>
        <?= Html::a(Yii::t('app', 'Create Tools'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->_name;
                }
            ],
            [
                'attribute' => 'cost',
                'value' => function ($data) {
                    return $data->cost . ' ' . $data->currencyType->_short_name;
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return empty($data->type_id) ? '-' : $data->type->_name;
                }
            ],
            'weight',
            [
                'attribute' => 'short_desc',
                'format'=>'html',
                'value' => function ($data) {
                    return $data->getFullShortDesc();
                }
            ],
            [
                'attribute' => 'desc',
                'format'=>'html',
                'value' => function ($data) {
                    return $data->getFullDesc();
                }
            ],
        ],
    ]) ?>

</div>
