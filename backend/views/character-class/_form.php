<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->dropDownList(\common\models\Character::getAllList()) ?>

    <?= $form->field($model, 'class_id')->dropDownList(\common\models\_Class::getAllList()) ?>
    <?= $form->field($model, 'base_class')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()) ?>

    <?= $form->field($model, 'level', [
        'options' => [
            'tag' => 'div',
            'class' => 'character-class-level',
        ],
    ])->textInput([
        'type' => 'number'
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
