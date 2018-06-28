<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProficiencyBonusLevelRel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proficiency-bonus-level-rel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proficiency_bonus')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
