<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MulticlassMagicLevelPoint */

$this->title = Yii::t('app', 'Create Multiclass Magic Level Point');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Multiclass Magic Level Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multiclass-magic-level-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
