<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterSpellPoints */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-spell-points-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->textInput() ?>

    <?= $form->field($model, 'spell_level')->textInput() ?>

    <?= $form->field($model, 'spell_point')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
