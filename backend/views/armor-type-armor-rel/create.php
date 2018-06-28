<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArmorTypeArmorRel */

$this->title = Yii::t('app', 'Create Armor Type Armor Rel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Armor Type Armor Rels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armor-type-armor-rel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
