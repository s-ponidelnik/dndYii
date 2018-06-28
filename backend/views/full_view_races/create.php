<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Race */

$this->title = Yii::t('app', 'Create Race');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
