<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassSavingThrows */

$this->title = Yii::t('app', 'Create Class Saving Throws');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Saving Throws'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-saving-throws-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
