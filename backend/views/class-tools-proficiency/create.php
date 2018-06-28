<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassToolsProficiency */

if ($model->sub_select == false)
    $this->title = Yii::t('app', 'Create Class Tools Proficiency');
else
    $this->title = Yii::t('app', 'Create Class Tools Proficiency for tools type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Tools Proficiencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-tools-proficiency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
