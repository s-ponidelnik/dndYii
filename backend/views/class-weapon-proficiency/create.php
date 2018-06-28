<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassWeaponProficiency */

$this->title = Yii::t('app', 'Create Class Weapon Proficiency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Weapon Proficiencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-weapon-proficiency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
