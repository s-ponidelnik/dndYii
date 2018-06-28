<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WeaponTypeWeaponRel */

$this->title = Yii::t('app', 'Create Weapon Type Weapon Rel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weapon Type Weapon Rels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weapon-type-weapon-rel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
