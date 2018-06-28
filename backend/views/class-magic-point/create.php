<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassMagicPoint */

$this->title = Yii::t('app', 'Create Class Magic Point');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Magic Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-magic-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
