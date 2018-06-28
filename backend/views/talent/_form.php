<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Talent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="talent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'count')->textInput(['type' => 'number']); ?>

    <?= $form->field($model, 'rest_condition')->dropDownList(\common\models\Talent::getRestTypes()); ?>
    <?= $form->field($model, 'scalable')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
