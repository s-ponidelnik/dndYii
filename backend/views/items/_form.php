<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_type')->dropDownList(\common\models\Items::getTypes());?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]);?>

    <?= $form->field($model, 'cost')->textInput(['type' => 'number']); ?>

    <?= $form->field($model, 'currency_type_id')->dropDownList(\common\models\Currency::getAllList());?>

    <?= $form->field($model, 'weight')->textInput(); ?>
    <?= $form->field($model, 'packable')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()); ?>

    <?= $form->field($model, 'short_description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
