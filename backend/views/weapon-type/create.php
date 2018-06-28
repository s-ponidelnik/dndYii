<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WeaponType */

$this->title = Yii::t('app', 'Create Weapon Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weapon Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weapon-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
