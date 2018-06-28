<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArmorProperty */

$this->title = Yii::t('app', 'Create Armor Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Armor Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armor-property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
