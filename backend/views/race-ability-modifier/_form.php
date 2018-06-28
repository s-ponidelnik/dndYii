<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RaceAbilityModifier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-ability-modifier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ability_id')->dropDownList(\common\models\Ability::getAllList()) ?>

    <?= $form->field($model, 'modifier')->textInput() ?>

    <?= $form->field($model, 'race_id')->dropDownList(\common\models\Race::getAllList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
