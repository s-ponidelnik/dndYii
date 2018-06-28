<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Map */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="map-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
    <?= $form->field($model, 'description')->textarea();?>
    <?= $form->field($model, 'image')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'gif', 'png'],
            'maxFileSize' => 1024*128,
            'maxSize' => 1024*128,
            'showPreview' => true,
            'showCaption' => false,
            'showRemove' => true,
            'showUpload' => false
        ]]); ?>


    <?= $form->field($model, 'type')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
