<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WeaponProperty */

$this->title = Yii::t('app', 'Create Weapon Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weapon Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weapon-property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
