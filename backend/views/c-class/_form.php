<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\_Class */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archetype')->textInput() ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\common\models\_Class::getAllList(true, true)) ?>

    <?= $form->field($model, 'hit_dice')->textInput() ?>
    <?= $form->field($model, 'first_level_hit_points')->textInput() ?>
    <?= $form->field($model, 'hit_points_per_level')->textInput() ?>
    <?= $form->field($model, 'hit_points_per_level_stable')->textInput() ?>
    <?= $form->field($model, 'caster_value')->textInput() ?>
    <?= $form->field($model, 'spell_ability_id')->dropDownList(\common\models\Ability::getAllList()) ?>

    <?= $form->field($model, 'class_skill_proficiency')->textInput() ?>

    <?= $form->field($model, 'magic_proficiency_type')->dropDownList(\common\models\_Class::magicProficiencyTypes()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
