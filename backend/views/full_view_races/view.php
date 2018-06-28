<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Race */

$this->title = $model->_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Races'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= Yii::t('app', 'Ability Score Increase'); ?>: </h3>
    <?php
    /** @var \common\models\RaceAbilityModifier $raceAbilityModifier */
    foreach ($model->allAbilityModifiers as $raceAbilityModifier) {
        ?>
        <h4><?= $raceAbilityModifier->ability->_name . ($raceAbilityModifier->modifier > 0 ? '+' : '-') . $raceAbilityModifier->modifier; ?></h4>
    <?php } ?>
    <h3><?= Yii::t('app', 'Speed'); ?>: </h3>
    <h4><?= Yii::t('app', 'Your base walking speed is {speed} feel', ['speed' => $model->speed]); ?></h4>

    <?php
    if (!empty($model->raceSkillProficiencies)) {
        ?>
        <h3><?= Yii::t('app', 'Your have proficiency in'); ?></h3>
        <?php
        /** @var \common\models\RaceSkillProficiency $raceSkillProficiency */
        foreach ($model->allSkillProficiencies as $raceSkillProficiency) { ?>
            <h4><?= $raceSkillProficiency->skill->_name; ?></h4>
        <?php }
    } ?>

    <?php
    /** @var \common\models\RaceTalent $raceTalent */
    foreach ($model->allTalents as $raceTalent) {
        ?>
        <h3><?= $raceTalent->talent->_name; ?></h3>
        <h4><?= $raceTalent->talent->description; ?></h4>
        <?php
    }
    ?>
</div>
