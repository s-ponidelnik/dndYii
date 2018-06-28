<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ClassSkillProficiency */

$this->title = Yii::t('app', 'Update Class Skill Proficiency: {skillName} for {className}', [
    'skillName' => $model->skill->name,
    'className' => $model->class->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Skill Proficiencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="class-skill-proficiency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
