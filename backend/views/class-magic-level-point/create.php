<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassMagicLevelPoint */

$this->title = Yii::t('app', 'Create Class Magic Level Point');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Magic Level Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-magic-level-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
