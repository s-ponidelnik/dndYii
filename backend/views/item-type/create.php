<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ItemType */

$this->title = Yii::t('app', 'Create Item Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
