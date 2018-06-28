<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Character */
\frontend\assets\CharacterAsset::register($this);
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<input type="hidden" value="<?= \yii\helpers\Url::to(['character/change_hp', 'id' => $model->id]) ?>"
       id="hp_changed_url">

<input type="hidden" value="<?= \yii\helpers\Url::to(['character/use_talent', 'id' => $model->id]) ?>"
       id="use_talent_url">
<input type="hidden" value="<?= \yii\helpers\Url::to(['character/rest_talent', 'id' => $model->id]) ?>"
       id="rest_talent_url">

<input type="hidden" value="<?= \yii\helpers\Url::to(['character/use_spell', 'id' => $model->id]) ?>"
       id="spell_use_url">
<input type="hidden" value="<?= \yii\helpers\Url::to(['character/rest', 'id' => $model->id]) ?>" id="spell_rest_url">
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
    <h1><?= Yii::t('app', 'HP'); ?>:

        <input type="number" value="<?= $model->hp; ?>" id="current_hp" style="width: 100px;">
        / <?= $model->max_hp; ?>

        <button type="button" class="btn btn-success" id="hp_save_btn">Save</button>
        <img id="hp_changed_load_img" style="display: none;"
             src="https://media0.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" width="80px;">
        <img id="hp_changed_ok_img" style="display: none;" src="http://igra-jeka.ru/upload/img/ok.png" width="35px;">
    </h1>
    <?php
    $spellPointsInfo = $model->getFullSpellPointsInfo();
    if (!empty($spellPointsInfo)) {
        ?>
        <table border="1px">
            <tr>
                <th style="padding: 10px;">Level</th>
                <th style="padding: 10px;">Used</th>
                <th style="padding: 10px;">Max Points</th>
                <th style="padding: 10px;">Use</th>
            </tr>
            <?php
            foreach ($spellPointsInfo as $spellLevel => $info) {
                ?>
                <tr>
                    <td style="padding: 10px;"><?= $spellLevel; ?></td>
                    <td style="padding: 10px;" class="spell-point-used-level-counter"
                        id="spell-point-used-level-<?= $spellLevel; ?>-counter"><?= $info['used']; ?></td>
                    <td style="padding: 10px;"><?= $info['max_points']; ?></td>
                    <td style="padding: 10px;">
                        <button type="button" class="btn btn-success btn_spell_point_use"
                                data-level="<?= $spellLevel; ?>">Use
                        </button>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>
    <?php } ?>
    <button type="button" class="btn btn-success btn_spell_point_rest">Rest</button>

    <h1>Сложность заклинаний: <?= $model->getSpellCasterDiff(); ?></h1>
    <h1>Бонус атаки заклинанием: <?= $model->getSpellCasterAttack(); ?></h1>
    <h1><?= Yii::t('app', 'AC'); ?>: <?= $model->ac; ?></h1>
    <h1><?= Yii::t('app', 'Speed'); ?>: <?= $model->speed; ?></h1>
    <a class="btn btn-info collapsed" href="#weigh" data-toggle="collapse"
       aria-expanded="false"><?= Yii::t('app', 'Info'); ?></a>
    <br>
    <div id="weigh" class="collapse" aria-expanded="false" style="height: 0px;">
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
    </div>
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
    <a class="btn btn-info collapsed" href="#encumbrance" data-toggle="collapse"
       aria-expanded="false"><?= Yii::t('app', 'Info'); ?></a>
    <ul id="encumbrance" class="collapse" aria-expanded="false" style="height: 0px;">
        <li><?= \common\helpers\EncumbranceHelper::encumbranceDescription()[\common\helpers\EncumbranceHelper::NONE_ENCUMBRANCE]; ?>
            : <?= $model->encumbranceLimits[0]; ?></li>
        <li><?= \common\helpers\EncumbranceHelper::encumbranceDescription()[\common\helpers\EncumbranceHelper::LITTLE_ENCUMBRANCE]; ?>
            : <?= $model->encumbranceLimits[1]; ?></li>
    </ul>
    <h3><?= Yii::t('app', 'Weapons'); ?></h3>
    <table border="1px"
    ">
    <tr>
        <th style="padding: 15px;">Оружие</th>
        <th style="padding: 15px;">Атака</th>
        <th style="padding: 15px;">Урон</th>
        <th style="padding: 15px;">Свойства</th>
    </tr>
    <?php
    foreach ($model->weapons as $weapon) {
        ?>
        <tr>
            <td style="padding: 15px;"><?= $weapon['name']; ?></td>
            <td style="padding: 15px;text-align: center;"><?= $weapon['attack']; ?></td>
            <td style="padding: 15px;text-align: center;"><?= $weapon['damage']; ?></td>
            <td style="padding: 15px;"><?= (empty($weapon['description']) ? '-' : $weapon['description']); ?></td>
        </tr>

        <?php
    }
    ?>
    </table>
    <h4><?= Yii::t('app', 'Ammunition'); ?></h4>
    <table border="1px" style="text-align: center;">
        <tr>
            <th style="padding: 10px;">Боезапас</th>
            <th style="padding: 10px;">Кол-во</th>
            <th style="padding: 10px;">Свойства</th>
        </tr>
        <?php
        foreach ($model->getAmmunition() as $ammunition) {
            ?>
            <tr>
                <td style="padding: 10px;"><?= $ammunition['name']; ?></td>
                <td style="padding: 10px;"><?= $ammunition['count']; ?></td>
                <td style="padding: 10px;"><?= (empty($ammunition['description']) ? '-' : $ammunition['description']); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <h4>
        <a class="btn btn-info collapsed" href="#equip" data-toggle="collapse"
           aria-expanded="false">Экипировано</a>
    </h4>
    <table border="1px" id="equip" class="collapse" aria-expanded="false" style="height: 0px;">
        <tr>
            <th style="padding: 10px;">Предмет</th>
            <th style="padding: 10px;">Описание</th>
        </tr>
        <tr>
            <?php
            foreach ($model->characterItems as $characterItem) {
            ?>
        <tr><?php
            if ($characterItem->equip) {
                ?>
                <td style="padding: 10px;"><?= $characterItem->item->name; ?></td>
                <td style="padding: 10px;">
                    <?php
                    if (!empty($characterItem->item->description))
                        echo $characterItem->item->description;
                    if ($characterItem->item->packable) {
                        $inItems = \common\models\CharacterItems::find()->where(['character_id' => $model->id, 'sub_item_id' => $characterItem->id])->all();
                        if (!empty($inItems)) {
                            $inItemsNames = [];
                            foreach ($inItems as $inItem) {
                                $inItemsNames[] = $inItem->item->name . '(' . $inItem->count . ')';
                            }
                            echo '<br>Содержит: ' . implode(',', $inItemsNames);
                        }
                    } elseif (empty($characterItem->item->description))
                        echo '-';
                    ?>
                </td>
                <?php
            }
            ?></tr><?php
        }
        ?>
        </tr>
    </table>


    <h3><?= Yii::t('app', 'Money'); ?></h3>
    <ul style="font-size: 20px;">
        <?php
        foreach ($model->characterMoney as $characterMoney) {
            ?>
            <li>
                <?= $characterMoney->count; ?> <?= $characterMoney->currencyType->_short_name; ?>
            </li>
            <?php
        }
        ?>
    </ul>
    <?= Yii::t('app', 'Load Weight'); ?>: <?= $model->loadWeight; ?><br>
    <a class="btn btn-info collapsed" href="#weigh2" data-toggle="collapse"
       aria-expanded="false"><?= Yii::t('app', 'Info'); ?></a>
    <div id="weigh2" class="collapse" aria-expanded="false" style="height: 0px;">
        <ul>
            <?php
            foreach ($model->loadWeightInfo as $itemInfo) {
                ?>
                <li><?= $itemInfo['item']->_name; ?>(<?= $itemInfo['one_weight'] . '*' . $itemInfo['count'] . '='; ?>
                    ): <?= $itemInfo['weight']; ?></li>
                <?php
            }
            ?>
        </ul>
    </div>

    <table border="1px">
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability'); ?></th>
        <!--<th style="padding: 5px;"><? //= Yii::t('app', 'Ability value'); ?></th>
        <th style="padding: 5px;"><? //= Yii::t('app', 'Race ability modifier'); ?></th>-->
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability value'); ?></th>
        <th style="padding: 5px;"><?= Yii::t('app', 'Ability modifier'); ?></th>
        <?php
        foreach ($model->getFullCharacterAbilities() as $ability) {
            ?>
            <tr>
                <td style="padding: 15px;width: 50px;">
                    <?= $ability->ability->_name; ?>
                </td>
                <!--    <td style="padding: 15px;width: 50px;">
                    <?//= $ability->value; ?>
                </td>
                <td style="padding: 15px;width: 50px;">
                    <?//= $ability->raceModifier; ?>
                </td>-->
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
    <table border="1px" style="text-align: center;">
        <?php
        foreach ($model->savingThrows as $ability => $modifier) {
            ?>
            <tr>
                <th style="padding: 5px;"><?= $ability; ?></th>
                <th style="padding: 5px;"><?= ($modifier >= 0 ? '+' . $modifier : $modifier); ?></th>
            </tr>
            <?php
        }
        ?>
    </table>
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

    <h1><?= Yii::t('app', 'Inventory'); ?></h1>
    <?php
    function getCharacterEquip($characterItems, $character_id)
    {
        ?>
        <ul class="list-group">
            <?php
            /** @var \common\models\CharacterItems $characterItem */
            foreach ($characterItems as $characterItem) {
                ?>
                <li class="list-group-item">
                    <?php
                    $characterSubItems = \common\models\CharacterItems::find()->where(['sub_item_id' => $characterItem->id, 'character_id' => $character_id])->all();
                    if (empty($characterSubItems)) {
                        ?><?= $characterItem->item->name; ?><?= ($characterItem->count > 1 ? '(' . $characterItem->count . 'шт.)' : ''); ?>
                        <i><?= $characterItem->item->description; ?></i>

                        <?php
                    } else {
                        ?>
                        <a class="btn btn-info collapsed" href="#item<?= $characterItem->id; ?>" data-toggle="collapse"
                           aria-expanded="false"><?= $characterItem->item->name; ?><?= ($characterItem->count > 1 ? '(' . $characterItem->count . 'шт.)' : ''); ?></a>
                        <i><?= $characterItem->item->description; ?></i>
                    <div id="item<?= $characterItem->id; ?>" class="collapse" aria-expanded="false"
                         style="height: 0px;">
                        <?php
                        getCharacterEquip($characterSubItems, $character_id);
                        ?></div><?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>

        </ul>
        <?php
    }

    $characterItems = \common\models\CharacterItems::find()->where(['sub_item_id' => null, 'character_id' => $model->id])->all();
    getCharacterEquip($characterItems, $model->id);
    ?>

    <?php foreach ($model->talents as $talent) {
        if (!in_array($talent->name, ['attack_2', 'armordef', 'handyman', 'dualdef', 'charAura', 'magic_diff_2', 'magic_diff_1', 'magic_attack_1', 'magic_attack_2'])) {
            ?>
            <h3><?= $talent->_fullname; ?><?= (!empty($talent->property) ? '(' . $talent->property . ')' : ''); ?></h3>
            <?php
            if (!empty($talent->count)) {
                ?>

                <h3><?= (isset($model->usedTalents[$talent->id]) ? $model->usedTalents[$talent->id] : 0); ?>
                    /<?= $talent->count; ?>
                    <button type="button" class="btn btn-success use_talent_btn" data-talent="<?= $talent->id; ?>">
                        Use
                    </button>
                    <button type="button" class="btn btn-success rest_talent_btn" data-talent="<?= $talent->id; ?>">
                        <?= $talent->rest_type; ?>
                    </button>
                </h3>
                <?php
            }
            ?>
            <h4><?= $talent->description; ?></h4>
            <?php
        }
    }
    ?>


</div>
