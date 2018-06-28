<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MapMarkers */
/* @var $form yii\widgets\ActiveForm */
$maps = \backend\models\MapSearch::names();
?>

<div class="map-markers-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $form->action = \yii\helpers\Url::to(['/map_markers/create_from_map']);
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'autofocus'=>true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos_x')->input('numeric');?>

    <?= $form->field($model, 'pos_y')->input('numeric');?>

    <?= $form->field($model, 'type')->dropDownList(\common\models\MapMarkers::types());?>

    <?= $form->field($model, 'map_id')->dropDownList($maps); ?>

    <?php $maps[0]='-';
    $param = ['options' =>[ '0' => ['Selected' => true]]];
    ?>
    <?=$form->field($model, 'sub_map_id')->dropDownList($maps,$param); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
