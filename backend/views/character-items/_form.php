<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="character-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'character_id')->dropDownList(\common\models\Character::getAllList()); ?>

    <?= $form->field($model, 'item_id')->dropDownList(\common\models\Items::getAllList()); ?>

    <?php
    if (empty($model->count))
        echo $form->field($model, 'count')->textInput(['type' => 'number', 'value' => 1]);
    else
        echo $form->field($model, 'count')->textInput(['type' => 'number']);
    ?>

    <?= $form->field($model, 'equip')->dropDownList(\common\helpers\DropDownHelper::BooleanDropDown()); ?>
    <?php
    if (!empty($model->character_id))
        echo $form->field($model, 'sub_item_id')->dropDownList(\common\models\CharacterItems::getForSubItems($model->character_id));
    else
        echo $form->field($model, 'sub_item_id')->textInput();
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
