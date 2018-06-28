<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\_Class */

$this->title = $model->_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <h2><?= Yii::t('app', 'Hit Points'); ?>: </h2>
        <h4><?= Yii::t('app', 'Hit Dice'); ?>: <?= Yii::t('app', '{hit_dice} per class: {class} level', [
                'hit_dice' => $model->hit_dice,
                'class' => $model->_name
            ]); ?></h4>
        <h4><?= Yii::t('app', 'Hit Points on first level'); ?>
            : <?= Yii::t('app', '{first_level_hit_points} + Constitution modifier', [
                'first_level_hit_points' => $model->first_level_hit_points
            ]); ?></h4>
        <h4><?= Yii::t('app', 'Hit Points per level'); ?>
            : <?= Yii::t('app', '{hit_per_level}(or {hit_per_level_stable}) + Constitution modifier per level of class: {className} after first level',
                [
                    'hit_per_level' => $model->hit_points_per_level,
                    'hit_per_level_stable' => $model->hit_points_per_level_stable,
                    'className' => $model->_name
                ]); ?></h4>

        <h2><?= Yii::t('app', 'Proficiencies'); ?>: </h2>
        <h4><b><?= Yii::t('app', 'Armors'); ?>:</b></h4>
        <?php
        $classArmorProfList = [];
        foreach ($model->classArmorProficiency as $classArmorProficiency) {
            $classArmorProfList[] = $classArmorProficiency->armorType->_name;
        }
        ?>
        <h4><?= implode(', ', $classArmorProfList); ?></h4>
        <h4><b><?= Yii::t('app', 'Weapons'); ?>:</b></h4>
        <?php
        $classWeaponProfList = [];
        foreach ($model->classWeaponProficiency as $classWeaponProficiency) {
            $classWeaponProfList[] = $classWeaponProficiency->weaponType->_name;
        }
        ?>
        <h4><?= implode(', ', $classWeaponProfList); ?></h4>

        <h4><b><?= Yii::t('app', 'Tools'); ?>:</b></h4>
        <?php
        $classToolsProfList = [];
        /** @var \common\models\ClassToolsProficiency $classToolsProficiency */
        foreach ($model->classToolsProficiency as $classToolsProficiency) {
            if ($classToolsProficiency->count > 1) {
                $classToolsProfList[] = Yii::t('app', '{count} {tools_type} to choose from', [
                    'tools_type' => $classToolsProficiency->toolsObject->_name,
                    'count' => $classToolsProficiency->count
                ]);
            }else{
                $classToolsProfList[] = $classToolsProficiency->toolsObject->_name;
            }
        }
        ?>
        <h4><?= implode(', ', $classToolsProfList); ?></h4>


        <h4><b><?= Yii::t('app', 'Skills'); ?>:</b></h4>
        <?php
        $classSkillProfList = [];
        foreach ($model->classSkillProficiencies as $classSkillProficiency) {
            $classSkillProfList[] = $classSkillProficiency->skill->name;
        }
        ?>

        <h4><?= Yii::t('app', '{count} skill proficiencies from skill list', [
                'count' => $model->class_skill_proficiency
            ]); ?>: <?= implode(', ', $classSkillProfList); ?></h4>
        <h4>
            <?php
            $classSavingThrowsList = [];
            foreach ($model->classSavingThrows as $classSavingThrows) {
                $classSavingThrowsList[] = $classSavingThrows->ability->name;
            }
            ?>

            <h4><b>
                    <?= Yii::t('app', 'Saving Throws'); ?>:</b></h4>
            <h4> <?= implode(', ', $classSavingThrowsList); ?></h4>
    </div>
</div>
