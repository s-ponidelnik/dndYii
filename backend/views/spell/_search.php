<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SpellSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spell-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'spell_property') ?>

    <?= $form->field($model, 'overlay_time') ?>

    <?php // echo $form->field($model, 'overlay_time_type') ?>

    <?php // echo $form->field($model, 'distance') ?>

    <?php // echo $form->field($model, 'components') ?>

    <?php // echo $form->field($model, 'duration_time') ?>

    <?php // echo $form->field($model, 'duration_time_type') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
