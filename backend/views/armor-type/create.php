<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArmorType */

if ($model->group == 1)
    $this->title = Yii::t('app', 'Create Armor Group');
else
    $this->title = Yii::t('app', 'Create Armor Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Armor Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armor-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
