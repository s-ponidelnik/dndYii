<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WeaponProperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weapon-property-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_id')->dropDownList(\common\models\Items::getWeaponList()); ?>

    <?= $form->field($model, 'damage_dice')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'attack_bonus')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'damage_bonus')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'fit')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()) ?>

    <?= $form->field($model, 'two_hand_damage_dice')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
