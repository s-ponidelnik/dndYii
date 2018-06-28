<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Character */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'race_id')->dropDownList(\common\models\Race::getAllList()) ?>

    <?= $form->field($model, 'hp', [
        'options' => [
            'tag' => 'div',
            'class' => 'character-hp',
        ],
    ])->textInput([
        'value' => null,
        'type' => 'number'
    ]); ?>

    <?= $form->field($model, 'max_hp', [
        'options' => [
            'tag' => 'div',
            'class' => 'character-hp',
        ],
    ])->textInput([
        'value' => null,
        'type' => 'number'
    ]); ?>

    <?= $form->field($model, 'exp', [
        'options' => [
            'tag' => 'div',
            'class' => 'character-exp',
        ],
    ])->textInput([
        'type' => 'number'
    ]); ?>
    <?=$form->field($model,'player_id')->dropDownList(\common\models\User::getAllList());?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
