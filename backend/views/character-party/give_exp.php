<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CharacterParty */
/* @var $form yii\widgets\ActiveForm */
$model = new \yii\base\DynamicModel(['party_identifier','exp']);
?>

<div class="character-party-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'party_identifier')->dropDownList($parties) ?>
    <?= $form->field($model, 'exp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
