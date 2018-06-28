<?php
$this->registerCss('
body{
background-image: url("
https://upload.wikimedia.org/wikipedia/commons/9/93/Crypt_of_the_Basilica_dei_Santi_Apostoli.JPG
") !important
}
');

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $name string */
/* @var $party array */
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
\frontend\assets\PartyAsset::register($this);
$this->title = $name;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-index" xmlns="http://www.w3.org/1999/html">

    <?php
    /** @var \common\models\CharacterParty $partyMember */
    foreach ($party as $partyMember) { ?>
        <div id="party-character" class="inline list-inline"
             style="background-color: #e8f2ed66;display: inline-block;margin:5px;padding: 10px;text-align: center;border-style: dashed;padding-top: 0px;">

            <span style="font-size: 35px;margin-bottom: 5px;"><?= $partyMember->character->name; ?></span></br>
            КД: <span style='
background-image: url("https://www.shareicon.net/download/2017/04/10/883528_lock_512x512.png");
background-size: 65px;
background-repeat: no-repeat;
width: 70px;
height: 70px;
font-size: 25px;
background-position-y: top;
background-position-x: center;
padding: 15px;
padding-top: 17px;
padding-left: 16px;
' class='ac'><?= $partyMember->character->ac; ?></span>
            <div class="character-avatar-container"
                 style=" width:200px;height:225px;overflow: hidden;border-radius: 40px;border-style: double;margin: 20px;">
                <div class="progress" style="
            position: absolute;
border-bottom-right-radius: 150px;
border-bottom-left-radius: 150px;
width: 190px;
padding: 0px;
margin: 0px;
    margin-top: 0px;
    margin-left: 0px;
margin-top: 0px;
margin-left: -4px;
height: 30px;
margin-top: 189px;
text-align: center;
margin-left: 3px;
background-color: #00000080;
">
                    <span style="color: white;
font-weight: bold;
font-size: 15px;
padding-left: 60px;
padding-right: 60px;
text-align: center;">
                    <span id='character_<?= $partyMember->character_id; ?>_hit_points_value'
                          class="current-hit-points-value"> <?= $partyMember->character->hp; ?></span> / <?= $partyMember->character->max_hp ?>
                </span>
                    <div id='character_<?= $partyMember->character_id; ?>_hit_points_progress_value' class="progress-bar progress-bar-<?= $partyMember->character->hpStatusText; ?>"
                         role="progressbar" aria-valuenow="<?= $partyMember->character->hp; ?>"
                         aria-valuemin="0" aria-valuemax="<?= $partyMember->character->max_hp ?>"
                         style="width:<?= $partyMember->character->percHp; ?>%">
                    </div>
                </div>
                <a href="<?= \yii\helpers\Url::to(['character/view', 'id' => $partyMember->character->id]) ?>"
                   target="_blank">
                    <img class="character-avatar" style="float: left;width: 200px;"
                         src="<?= $partyMember->character->icon_src; ?>">
                </a>
            </div>
            <ul class="list-unstyled left-column">
                <li style="text-align: center;"><img src="https://image.flaticon.com/icons/png/128/61/61483.png"
                                                     style="width: 15px;height: 15px;"> <?= $partyMember->character->moneyString; ?>
                </li>
                <li style="text-align: center; min-height: 150px;max-width: 200px;overflow: hidden;padding-top: 10px;"
                    class="spell-points">
                    <ul class="list-unstyled">
                        <?php $spellPointsInfo = $partyMember->character->getFullSpellPointsInfo();
                        foreach ($spellPointsInfo as $spellLevel => $info) {
                            ?>
                            <li style="text-align: center;"><img
                                        src="https://cdn4.iconfinder.com/data/icons/video-game-items-concepts/128/magic-spell-book-open-512.png"
                                        style="width: 15px;height: 15px;"><?= $spellLevel; ?>
                                Уровень: <?= $info['max_points'] - $info['used']; ?>/<?=$info['max_points']?></li>

                            <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    <?php }
    ?>

</div>
