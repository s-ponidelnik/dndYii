<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterSkill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-skill-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->dropDownList(\common\models\Character::getAllList()) ?>

    <?= $form->field($model, 'skill_id')->dropDownList(\common\models\Skill::getAllList()) ?>

    <?= $form->field($model, 'proficiency')->dropDownList(
            [
                    0=>Yii::t('app','No'),
                    1=>Yii::t('app','Yes'),
                ]
    ) ?>

    <?= $form->field($model, 'expertise')->dropDownList(
        [
            0=>Yii::t('app','No'),
            1=>Yii::t('app','Yes'),
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
