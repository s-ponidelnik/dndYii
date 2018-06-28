<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClassTalent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-talent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownList(\common\models\_Class::getAllList()) ?>

    <?= $form->field($model, 'talent_id')->dropDownList(\common\models\Talent::getAllList()) ?>
    <?= $form->field($model, 'property')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'level', [
        'options' => [
            'tag' => 'div',
            'class' => 'class-talent-level',
        ],
    ])->textInput([
        'value' => 1,
        'type' => 'number'
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
