<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NoteTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'note_id')->dropDownList(\common\models\Note::getAllList(false)) ?>

    <?= $form->field($model, 'tag_id')->dropDownList(\common\models\Tag::getAllList()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
