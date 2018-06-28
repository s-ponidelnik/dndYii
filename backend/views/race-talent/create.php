<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RaceTalent */

$this->title = Yii::t('app', 'Create Race Talent/Feature');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Race Talents/Feature'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-talent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
