<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClassMagicLevelPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-magic-level-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownList(\common\models\_Class::getAllList(true,false)) ?>
    <?= $form->field($model, 'level')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'spell_level')->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'spell_point')->textInput(['type'=>'number']) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
