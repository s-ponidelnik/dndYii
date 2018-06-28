<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WeaponTypeWeaponRel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weapon-type-weapon-rel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weapon_id')->dropDownList(\common\models\Weapon::getAllList()) ?>

    <?= $form->field($model, 'type_id')->dropDownList(\common\models\WeaponType::getAllList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
