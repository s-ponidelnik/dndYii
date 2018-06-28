<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClassWeaponProficiency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-weapon-proficiency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownList(\common\models\_Class::getAllList()) ?>

    <?= $form->field($model, 'weapon_type_id')->dropDownList(\common\models\WeaponType::getAllList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
