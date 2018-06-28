<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArmorPropertySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armor-property-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'ac') ?>

    <?= $form->field($model, 'str') ?>

    <?php // echo $form->field($model, 'stealth_disadvantage') ?>

    <?php // echo $form->field($model, 'dex_mod') ?>

    <?php // echo $form->field($model, 'dex_mod_limit') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
