<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MapMarkers */

$this->title = Yii::t('app', 'Create Map Markers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Map Markers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-markers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('modal_create_form', [
        'model' => $model,
    ]) ?>

</div>
