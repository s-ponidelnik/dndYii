<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassArmorProficiency */

$this->title = Yii::t('app', 'Create Class Armor Proficiency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Armor Proficiencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-armor-proficiency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
