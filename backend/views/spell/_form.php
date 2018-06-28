<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Spell */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spell-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'spell_school_id')->dropDownList(\common\models\SpellSchool::getAllList()); ?>

    <?= $form->field($model, 'overlay_time')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'overlay_time_type')->dropDownList(\common\models\Spell::getTimeType()) ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <?= $form->field($model, 'components')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duration_time')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'duration_time_type')->dropDownList(\common\models\Spell::getTimeType()) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'concentration')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
