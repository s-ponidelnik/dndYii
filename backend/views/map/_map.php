<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Map */
?>
<div class="map-item content">
    <hr class="map-item sep">
    <div class="map-item min-img">
        <?= Html::a(Html::img(Yii::$app->params['uploadsUrl'] . '/' . $model->img_name, ['class' => 'map-min-img']), ['view', 'id' => $model->id]); ?>
    </div>
    <div class="map-item content-block">

        <h1 class="map-item header"><?= Html::encode($model->name); ?>

            <?= Html::a('', ['update', 'id' => $model->id], ['class' => 'glyphicon glyphicon-edit']) ?>
            <?= Html::a('', ['delete', 'id' => $model->id], [
                'class' => 'glyphicon glyphicon-trash',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

        </h1>
        <p class="map-item description">
            <?= Html::encode($model->description); ?>
        </p>
    </div>

</div>

