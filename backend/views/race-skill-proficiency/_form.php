<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RaceSkillProficiency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-skill-proficiency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'skill_id')->dropDownList(\common\models\Skill::getAllList()) ?>

    <?= $form->field($model, 'race_id')->dropDownList(\common\models\Race::getAllList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
