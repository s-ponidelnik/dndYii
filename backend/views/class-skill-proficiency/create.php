<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassSkillProficiency */

$this->title = Yii::t('app', 'Create Class Skill Proficiency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Skill Proficiencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-skill-proficiency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
