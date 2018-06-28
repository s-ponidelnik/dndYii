<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ToolsType */

$this->title = Yii::t('app', 'Create Tools Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tools Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
