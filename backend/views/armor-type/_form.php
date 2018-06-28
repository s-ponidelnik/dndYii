<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArmorType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armor-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php if ($model->group != 1) { ?>
        <?= $form->field($model, 'don')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'don_time_type')->dropDownList(\common\models\ArmorType::getTimeTypes()); ?>
        <?= $form->field($model, 'doff')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'doff_time_type')->dropDownList(\common\models\ArmorType::getTimeTypes()); ?>
        <?= $form->field($model, 'additional_ac')->dropDownList([false => Yii::t('app', 'No'), true => Yii::t('app', 'Yes')]); ?>
    <?php } else { ?>
        <?= $form->field($model, 'group')->hiddenInput(['value' => 1]); ?>
    <?php } ?>
    <?= $form->field($model, 'desc')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
