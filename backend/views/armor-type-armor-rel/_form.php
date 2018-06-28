<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArmorTypeArmorRel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armor-type-armor-rel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'armor_id')->dropDownList(\common\models\Armor::getAllList()) ?>
    <?= $form->field($model, 'type_id')->dropDownList(\common\models\ArmorType::getAllGroupList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
