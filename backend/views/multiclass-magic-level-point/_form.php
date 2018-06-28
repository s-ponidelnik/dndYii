<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MulticlassMagicLevelPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multiclass-magic-level-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'spell_level')->textInput() ?>

    <?= $form->field($model, 'spell_point')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
