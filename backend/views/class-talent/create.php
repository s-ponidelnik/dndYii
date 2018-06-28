<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassTalent */

$this->title = Yii::t('app', 'Create Class Talent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Talents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-talent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
