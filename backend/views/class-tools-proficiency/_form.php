<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClassToolsProficiency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-tools-proficiency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($model->sub_select == true) {
        echo $form->field($model, 'count', [
            'options' => [
                'tag' => 'div',
                'class' => 'class-tools-proficiency-count',
            ],
        ])->textInput([
            'value' => 1,
            'type' => 'number'
        ]);
    } else {
        echo $form->field($model, 'count')->hiddenInput(['value' => 1]);
    }
    ?>

    <?php
    if ($model->sub_select == false) {
        echo $form->field($model, 'tools_object_id')->dropDownList(\common\models\Tools::getAllList());
    } else {
        echo $form->field($model, 'tools_object_id')->dropDownList(\common\models\ToolsType::getAllList());
    }
    ?>

    <?= $form->field($model, 'class_id')->dropDownList(\common\models\_Class::getAllList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
