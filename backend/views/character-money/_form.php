<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterMoney */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-money-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->dropDownList(\common\models\Character::getAllList()) ?>


    <?= $form->field($model, 'currency_type_id')->dropDownList(\common\models\Currency::getAllList(false)) ?>

    <?= $form->field($model, 'count')->textInput(['type'=>'number']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
