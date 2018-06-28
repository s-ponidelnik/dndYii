<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProficiencyBonusLevelRel */

$this->title = Yii::t('app', 'Update Proficiency Bonus Level Rel: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proficiency Bonus Level Rels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="proficiency-bonus-level-rel-update">
    <p>
        <?= Html::a(Yii::t('app', 'Create Proficiency Bonus Level Rel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
