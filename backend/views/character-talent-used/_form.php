<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterTalentUsed */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-talent-used-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->textInput() ?>

    <?= $form->field($model, 'talent_id')->textInput() ?>

    <?= $form->field($model, 'used')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
