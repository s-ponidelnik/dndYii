<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterParty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-party-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->dropDownList(\common\models\Character::getAllList()) ?>

    <?= $form->field($model, 'party_identifier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'party_leader')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
