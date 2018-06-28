<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RaceSkillProficiency */

$this->title = Yii::t('app', 'Create Race Skill Proficiency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Race Skill Proficiencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-skill-proficiency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
