<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\items\CharacterItemsWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Character */
\frontend\assets\_CharacterAsset::register($this);
$this->title = $model->name;
?>
<div id="msg_container"></div>


<input type="hidden" value="<?= \yii\helpers\Url::to(['character/_change_hp', 'id' => $model->id]) ?>"
       id="hp_changed_url">
<input type="hidden" value="<?= \yii\helpers\Url::to(['character/_use_talent', 'id' => $model->id]) ?>"
       id="use_talent_url">
<input type="hidden" value="<?= \yii\helpers\Url::to(['character/use_spell', 'id' => $model->id]) ?>"
       id="spell_use_url">
<input type="hidden" value="<?= \yii\helpers\Url::to(['character/rest', 'id' => $model->id]) ?>" id="spell_rest_url">
<!-- Modal -->
<div class="modal fade" id="damageModal" tabindex="-1" role="dialog" aria-labelledby="damageModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="damageModalLabel">Урон/Лечение</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Изменение здоровья: <input type="number" id="change_hp_input" value="0">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary" id="btn_change">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<div class="row info-panel">
    <div class="col-md-4 left-column">
        <div class="row">
            <div class="col-md-12">
                <div class="character-avatar-container"
                     style=" width:100px;height:100px;overflow: hidden;border-radius: 50px;">
                    <img class="character-avatar" style="float: left;width: 100px;"
                         src="<?= $model->icon_src; ?>">
                </div>
                <h2 class="character-name" style="display: inline;"><?= $model->name; ?></h2>
                <?= $model->race->mainRace->_name; ?>
                <?= $model->classesInfo; ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active"
                         style="width:<?= $model->progressExpLevel(); ?>%" role="progressbar"
                         aria-valuenow="<?= $model->exp; ?>" aria-valuemin="<?= $model->getCharacterExpPosInfo()[0]; ?>"
                         aria-valuemax="<?= $model->getCharacterExpPosInfo()[1]; ?>" data-toggle="tooltip"
                         title="<?= $model->exp; ?> / <?= $model->getCharacterExpPosInfo()[1]; ?>"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 right-column">
        <div class="row">
            <div class="col-md-2 block proficiency">
                <div class="count"><?= $model->proficiencyBonus_string; ?></div>
                <div class="name">Бонус Мастерства</div>
            </div>
            <div class="col-md-2 block ac">
                <div class="count"><?= $model->ac; ?></div>
                <div class="name">Класс Доспеха</div>
            </div>
            <div class="col-md-2 block speed">
                <div class="count"><?= $model->speed; ?></div>
                <br>
                <div class="name">Скорость</div>
            </div>
            <div class="col-md-2 block passive-wisdom">
                <div class="count"><?= $model->passivePerception; ?></div>
                <div class="name">Внимательность</div>
            </div>
            <div class="col-md-2 block initiative">
                <div class="count"><?= $model->initiative; ?></div>
                <div class="name">Инициатива</div>
            </div>
            <div class="col-md-2 block hit-points">
                <div class="hit-points" data-toggle="modal" data-target="#damageModal">
                    <span class="count current-hit-points" data-character-id="<?= $model->id; ?>"
                          id="current_hit_points"><?= $model->hp; ?></span>
                    <span class="count max-hit-points"><?= $model->max_hp; ?></span>
                </div>
                <button type="button" class="btn btn-primary inspiration-btn">Вдохновение</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 ability-container block-container">
        <div class="content">
            <div class="title">Характеристики</div>
            <div class="container-content">
                <ul class="list-unstyled">
                    <?php
                    foreach ($model->getFullCharacterAbilities() as $ability) {
                        ?>
                        <li>
                            <div class="row">
                                <div class="col-md-6 left-column">
                                    <span class="icon ability-<?= mb_strtolower($ability->ability->nameID); ?>-icon"></span>
                                    <span class="value"><?= $ability->finalValue; ?></span>
                                    <span class="name" data-toggle="tooltip"
                                          title="<?= $ability->ability->desc; ?>"><?= $ability->ability->_name; ?></span>
                                </div>
                                <div class="col-md-6 left-column">
                                    <span class="info-label">Mod</span><span
                                            class="modifier count"><?= $ability->modifier_string; ?></span>
                                    <span class="info-label">SAVE</span><span
                                            class="saving-throw count"><?= $model->savingThrows[$ability->ability->name]; ?></span>
                                    <span data-toggle="tooltip" title="Владение"
                                          class="character-ability-proficiency-marker <?= $model->profInSavingThrow($ability->ability->id); ?>"></span>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <!--<span class="ability-additional-info">
                    <h4>Дополнительные данные о спасбросках</h4>
                    <ul class="list-unstyled">
                        <li>Дополнительные данные о спасбросках</li>
                        <li>Дополнительные данные о проверках хар-к</li>
                    </ul>
                </span>-->
            </div>
        </div>
    </div>
    <div class="col-md-4 block-container skills">
        <div class="content">
            <div class="title">Навыки</div>
            <div class="container-content skill-subsection">
                <ul class="list-unstyled skill-lists">
                    <?php
                    foreach ($model->skills as $skill) {
                        ?>
                        <li class="skill-item">
                            <div class="row">
                                <div class="col-md-9 left-column skill-column">
                                    <span class="name <?= (mb_strlen($skill['skill']->_name) > 13 ? 'tenPxSize' : ''); ?>"
                                          data-toggle="tooltip"
                                          title="<?= $skill['skill']->desc; ?>"><?= $skill['skill']->_name; ?></span>
                                    <?php if ($skill['proficiency'] && $skill['expertise']) { ?>
                                        <span data-toggle="tooltip" title="Компетентность"
                                              class="marker skill-expertise-marker <?= ($skill['expertise'] ? 'active' : 'disable'); ?>"></span>
                                    <?php } else { ?>
                                        <span data-toggle="tooltip" title="Владение"
                                              class="marker skill-proficiency-marker <?= ($skill['proficiency'] ? 'active' : 'disable'); ?>"></span>
                                    <?php } ?>
                                </div>
                                <div class="col-md-3 right-column">
                                    <span class="modifier count"><?= $skill['value_string']; ?></span>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <!--<span class="skills-additional-info">
                    <h4>Дополнительные данные о навыках</h4>
                </span>-->
            </div>

        </div>
    </div>
    <div class="col-md-4 block-container weapons">
        <div class="content">
            <div class="title">Оружие</div>
            <ul class="list-unstyled character-weapons">
                <?php foreach ($model->weapons as $id => $weapon) { ?>
                    <li class="weapon-item">
                        <div class="row">
                            <a class="col-md-6 weapon-name" data-toggle="collapse"
                               href="#collapseWeapon<?= (!empty($weapon['description']) ? $id : '-'); ?>"
                               role="button" aria-expanded="false"
                               aria-controls="collapseWeapon<?= $id; ?>"><?= $weapon['name']; ?></a>
                            <span class="col-md-3 weapon-attack"><?= $weapon['attack']; ?></span>
                            <span class="col-md-3 weapon-damage"><?= $weapon['damage']; ?></span>
                        </div>

                        <div class="row collapse" id="collapseWeapon<?= $id; ?>">
                            <div class="col-md-12 card card-body">
                                <?= (empty($weapon['description']) ? '-' : $weapon['description']); ?>
                            </div>
                        </div>

                    </li>
                <?php } ?>
                <ul>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-4 block-container talents">
        <div class="content">
            <div class="title">Таланты</div>
            <div class="container-content">
                <ul class="list-unstyled">
                    <?php foreach ($model->talents as $talent) {
                        if (!in_array($talent->name, ['archery_2', 'attack_2', 'armordef', 'handyman', 'dualdef', 'charAura', 'magic_diff_2', 'magic_diff_1', 'magic_attack_1', 'magic_attack_2'])) {
                            $used = isset($model->usedTalents[$talent->id]) ? $model->usedTalents[$talent->id] : 0;
                            ?>
                            <li>
                                <a class="talent-name" data-toggle="collapse" href="#collapse<?= $talent->id; ?>"
                                   role="button" aria-expanded="false"
                                   aria-controls="collapse<?= $talent->id; ?>"><?= $talent->_fullname; ?><?= (!empty($talent->property) ? '(' . $talent->property . ')' : ''); ?></a>
                                <?php if ($talent->count) {
                                    if ($talent->scalable) {
                                        ?>
                                        <input type="number" class="use-number-input" value="1"
                                               id="talent_<?= $talent->id; ?>_use_count_input">
                                    <?php } ?>
                                    <button type="button" class="btn btn-success"
                                            id="use_talent_btn" data-talent-id="<?= $talent->id; ?>"
                                            data-scalable="<?= $talent->scalable; ?>">
                                        Осталось: <b
                                                id="talent_<?= $talent->id; ?>_use_left"><?= ($talent->count - $used); ?></b>
                                    </button>
                                <?php } ?>
                                <div class="collapse" id="collapse<?= $talent->id; ?>">
                                    <div class="card card-body">
                                        <?= $talent->description; ?>
                                    </div>
                                </div>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4 block-container spells">
        <div class="content">
            <div class="title">Ячейки заклинаний</div>
            <div class="container-content">
                <div class="spell-caster-level-description" style="text-align: left;">
                    <h4>Сложность заклинаний: <?= $model->getSpellCasterDiff(); ?></h4>
                    <h4>Бонус атаки заклинанием: <?= $model->getSpellCasterAttack(); ?></h4>
                </div>
                </br>
                <?php
                $spellPointsInfo = $model->getFullSpellPointsInfo();
                if (!empty($spellPointsInfo)) {
                ?>
                <table class="spells-table">
                    <tr>
                        <th>Уровень</th>
                        <th>Максимум</th>
                        <th>Осталось</th>
                        <th>Использовать</th>
                    </tr>
                    <?php

                    foreach ($spellPointsInfo as $spellLevel => $info) {
                        //$spellLevel;

                        ?>
                        <tr>
                            <td class="spell-count"><?= $spellLevel; ?>
                            </td>
                            <td class="spell-count"><?= $info['max_points']; ?></td>
                            <td class="spell-count spell-point-used-level-<?= $spellLevel; ?>"><?= $info['max_points'] - $info['used']; ?></td>
                            <td>
                                <button type="button" data-level="<?= $spellLevel; ?>"
                                        class="btn btn-success btn_spell_point_use">Использовать
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    } ?>
                </table>
                </br>
                <button style='float: left;' type="button" class="btn btn-success btn_spell_point_rest">Восстановить
                    ячейки
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4 block-container notes">
        <div class="content">
            <div class="title">Вещи</div>
            <div class="container-content">
                <?= $model->moneyString; ?>
                <?php echo CharacterItemsWidget::widget(['items' => $model->mainItems]); ?>
                <span style="color:<?php
                if ($model->encumbranceStatusInfo == \common\helpers\EncumbranceHelper::LITTLE_ENCUMBRANCE) {
                    echo 'yellow';
                } elseif ($model->encumbranceStatusInfo == \common\helpers\EncumbranceHelper::HEAVY_ENCUMBRANCE) {
                    echo 'red';
                } else {
                    echo 'green';
                }
                ?>;">
        <?= $model->encumbranceStatusInfo['text']; ?>(<?= $model->loadWeight; ?>)
        </span>
                <a class="btn btn-info collapsed" href="#weigh2" data-toggle="collapse"
                   aria-expanded="false"><?= Yii::t('app', 'Info'); ?></a>
                <div id="weigh2" class="collapse" aria-expanded="false" style="height: 0px;">
                    <ul>
                        <?php
                        foreach ($model->loadWeightInfo as $itemInfo)
                        {
                            if ($itemInfo['weight'] != 0) {
                                ?>
                                <li><?= $itemInfo['item']->_name; ?>
                                    (<?= $itemInfo['one_weight'] . '*' . $itemInfo['count'] . '='; ?>
                                    ): <?= $itemInfo['weight']; ?></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
