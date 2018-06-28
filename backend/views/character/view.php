<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Character */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <h1><?= Yii::t('app', 'AC'); ?>: <?= $model->ac; ?></h1>
    <span>
        <ul>
        <?php
        foreach ($model->getCharacterAcInfo()['items'] as $item) {
            ?>
            <li><?= $item['item']->_name; ?>: <?= $item['ac']; ?></li>
            <?php
        }
        ?>
            </ul>
    </span>
    <span style="color:<?php
    if ($model->encumbranceStatusInfo == \common\helpers\EncumbranceHelper::LITTLE_ENCUMBRANCE) {
        echo 'yellow';
    } elseif ($model->encumbranceStatusInfo == \common\helpers\EncumbranceHelper::HEAVY_ENCUMBRANCE) {
        echo 'red';
    } else {
        echo 'green';
    }
    ?>;">
        <?= $model->encumbranceStatusInfo['text']; ?>
        </span>
    <br>
    <ul>
        <li><?= \common\helpers\EncumbranceHelper::encumbranceDescription()[\common\helpers\EncumbranceHelper::NONE_ENCUMBRANCE]; ?>
            : <?= $model->encumbranceLimits[0]; ?></li>
        <li><?= \common\helpers\EncumbranceHelper::encumbranceDescription()[\common\helpers\EncumbranceHelper::LITTLE_ENCUMBRANCE]; ?>
            : <?= $model->encumbranceLimits[1]; ?></li>
    </ul>
    <?= Yii::t('app', 'Load Weight'); ?>: <?= $model->loadWeight; ?>
    <ul>
        <?php
        foreach ($model->loadWeightInfo as $itemInfo) {
            ?>
            <li><?= $itemInfo['item']->_name; ?>(<?= $itemInfo['item']->weight; ?>): <?= $itemInfo['weight']; ?></li>
            <?php
        }
        ?>
    </ul>
    <h1><?= $model->hp; ?> / <?= $model->max_hp; ?></h1>
    <h1><?= Yii::t('app', 'Speed'); ?>: <?= $model->speed; ?></h1>
    <table border="1px">
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability value'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Race ability modifier'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability value'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability modifier'); ?></th>
        <?php
        foreach ($model->getFullCharacterAbilities() as $ability) {
            ?>
            <tr>
                <td style="padding: 15px;width: 50px;">
                    <?= $ability->ability->_name; ?>
                </td>
                <td style="padding: 15px;width: 50px;">
                    <?= $ability->value; ?>
                </td>
                <td style="padding: 15px;width: 50px;">
                    <?= $ability->raceModifier; ?>
                </td>
                <td style="padding: 15px;width: 50px;">
                    <?= $ability->finalValue; ?>
                </td>
                <td style="padding: 15px;width: 50px;">
                    <?= $ability->modifier_string; ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <h2><?= Yii::t('app', 'Proficiency Bonus'); ?>: <?= $model->proficiencyBonus_string; ?></h2>
    <h2><?= Yii::t('app', 'Saving Throws'); ?></h2>
    <h2><?= Yii::t('app', 'Skills'); ?></h2>
    <table border="1px" style="text-align: center;">
        <th style="padding: 5px;"><?= Yii::t('app', 'Skill'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Value'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Proficiency'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Expertise'); ?></th>
        <?php
        foreach ($model->skills as $skill) {
            ?>
            <tr>
                <td><?= $skill['skill']->_name; ?></td>
                <td><?= $skill['value_string']; ?></td>
                <td><?= ($skill['proficiency'] ? '+' : '-'); ?></td>
                <td><?= ($skill['expertise'] ? '+' : '-'); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php foreach ($model->talents as $talent) { ?>
        <h3><?= $talent->_fullname; ?></h3>
        <h4><?= $talent->description; ?></h4>
        <?php
    }
    ?>


</div>
