<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SpellSchool */

$this->title = Yii::t('app', 'Create Spell School');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spell Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spell-school-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
