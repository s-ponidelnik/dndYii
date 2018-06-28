<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MulticlassMagicLevelPoint */

$this->title = Yii::t('app', 'Update Multiclass Magic Level Point: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Multiclass Magic Level Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="multiclass-magic-level-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
