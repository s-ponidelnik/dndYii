<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArmorProperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armor-property-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_id')->dropDownList(\common\models\Items::getArmorsList()); ?>

    <?= $form->field($model, 'type_id')->dropDownList(\common\models\ArmorType::getTypeList());?>

    <?= $form->field($model, 'ac')->textInput() ?>

    <?= $form->field($model, 'str')->textInput() ?>

    <?= $form->field($model, 'stealth_disadvantage')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown());?>

    <?= $form->field($model, 'dex_mod')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown());?>

    <?= $form->field($model, 'dex_mod_limit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
