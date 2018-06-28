<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Map */

?>
<div class="map-view" style="float:left;min-height:450px;max-height:500px;min-width:250px;padding: 10px;margin:10px;border:1px;border-style:solid;border-radius: 20px;max-width: 300px;">

    <h1><?= Html::encode($model->name);?></h1>
    <div style="max-height: 150px;overflow: auto;"><?=Html::encode($model->description);?></div>
    <div style="text-align: center;padding-top: 10px;">
    <?=Html::a(Html::img(Yii::$app->params['uploadsUrl'].'/'.$model->img_name,['style'=>['max-height'=>'200px','max-width'=>'280px','border'=>'1px','border-radius'=>'10px']]),['view', 'id' => $model->id]);?>
    </div>
    <p style="text-align: center;padding-top: 10px;">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>
