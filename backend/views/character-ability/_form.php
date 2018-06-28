<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterAbility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-ability-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->dropDownList(\common\models\Character::getAllList()) ?>

    <?= $form->field($model, 'ability_id')->dropDownList(\common\models\Ability::getAllList()) ?>
    <?= $form->field($model, 'value', [
        'options' => [
            'tag' => 'div',
            'class' => 'character-ability-value',
        ],
    ])->textInput([
        'type' => 'number'
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
