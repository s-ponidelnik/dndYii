<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Race */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
    $raceList = \common\models\Race::getAllList(false);
    $raceList[null] = '-';
    ?>
    <?= $form->field($model, 'parent_id')->dropDownList($raceList) ?>

    <?= $form->field($model, 'speed')->textInput() ?>
    <?= $form->field($model, 'playable')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown());?>


    <?= $form->field($model, 'ideology')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($model, 'age')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'size')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'names')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($model, 'info')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 12],
        'preset' => 'basic'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
