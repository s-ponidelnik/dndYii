<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProficiencyBonusLevelRel */

$this->title = Yii::t('app', 'Create Proficiency Bonus Level Rel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proficiency Bonus Level Rels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proficiency-bonus-level-rel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
