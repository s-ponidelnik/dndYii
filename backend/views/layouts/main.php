<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
if (!Yii::$app->user->isGuest)
/*for js auth*/Yii::$app->view->registerJs('var auth_token = "'. Yii::$app->user->identity->getAuthKey().'"',  \yii\web\View::POS_HEAD);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] = ['label' => Yii::t('app', 'Classes'), 'url' => ['/full_view_classes/index']];
        $menuItems[] = ['label' => Yii::t('app', 'Tags'), 'url' => ['/tag/index']];
        $menuItems[] = ['label' => Yii::t('app', 'Races'), 'url' => ['/full_view_races/index']];
        $menuItems[] = [
            'label' => Yii::t('app', 'Notes'),
            'items' => [
                ['label' => Yii::t('app', 'Notes'), 'url' => ['/note/index']],
                ['label' => Yii::t('app', 'Note tag'), 'url' => ['/note-tag/index']],
            ]
        ];
        $menuItems[] = [
                'label'=>Yii::t('app','Spells'),
            'items'=>[
                ['label' => Yii::t('app', 'Spells'), 'url' => ['/spell/index']],
                ['label' => Yii::t('app', 'Spell school'), 'url' => ['/spell-school/index']]
                ]
        ];
        $menuItems[] = ['label' => Yii::t('app', 'character-talent-used'), 'url' => ['/character-talent-used/index']];
        $menuItems[] = [
            'label' => Yii::t('app', 'Items'),
            'items' => [
                ['label' => Yii::t('app', 'Items'), 'url' => ['/items/index']],
                ['label' => Yii::t('app', 'character-money'), 'url' => ['/character-money/index']],
                ['label' => Yii::t('app', 'armor-property'), 'url' => ['/armor-property/index']],
                ['label' => Yii::t('app', 'weapon-property'), 'url' => ['/weapon-property/index']],
                ['label' => Yii::t('app', 'character-items'), 'url' => ['/character-items/index']],
                ['label' => Yii::t('app', 'Tools Types'), 'url' => ['/tools-type/index']],
                ['label' => Yii::t('app', 'Tools'), 'url' => ['/tools/index']],
                ['label' => Yii::t('app', 'Armor Types'), 'url' => ['/armor-type/index']],
                ['label' => Yii::t('app', 'Weapon Types'), 'url' => ['/weapon-type/index']],
                ['label' => Yii::t('app', 'Currency'), 'url' => ['/currency/index']],
                ['label' => Yii::t('app', 'Weapon Properties'), 'url' => ['/weapon-properties/index']],
                ['label' => Yii::t('app', 'Create Armor Group'), 'url' => ['/armor-type/create-group']],
                ['label' => Yii::t('app', 'Armor Groups'), 'url' => ['/armor-type-armor-rel/index']],
                ['label' => Yii::t('app', 'Create Weapon Group'), 'url' => ['/weapon-type/create-group']],
                ['label' => Yii::t('app', 'Weapon Groups'), 'url' => ['/weapon-type-weapon-rel/index']],
            ]
        ];
        $menuItems[] = [
            'label' => Yii::t('app', 'Character'),
            'items' => [
                ['label' => Yii::t('app', 'Character items'), 'url' => ['character-item/index']],
                ['label' => Yii::t('app', 'character-party'), 'url' => ['character-party/index']],
                ['label' => Yii::t('app', 'multiclass-magic-level-point'), 'url' => ['multiclass-magic-level-point/index']],
                ['label' => Yii::t('app', 'character-spell-points'), 'url' => ['character-spell-points/index']],
                ['label' => Yii::t('app', 'Class tools proficiency'), 'url' => ['class-tools-proficiency/index']],
                ['label' => Yii::t('app', 'Class armor proficiency'), 'url' => ['class-armor-proficiency/index']],
                ['label' => Yii::t('app', 'Class weapon proficiency'), 'url' => ['class-weapon-proficiency/index']],
                ['label' => Yii::t('app', 'Class Saving Throws'), 'url' => ['/class-saving-throws/index']],
                ['label' => Yii::t('app', 'Abilities'), 'url' => ['/ability/index']],
                ['label' => Yii::t('app', 'Skills'), 'url' => ['/skill/index']],
                ['label' => Yii::t('app', 'Races'), 'url' => ['/race/index']],
                ['label' => Yii::t('app', 'Race abilities'), 'url' => ['/race-ability-modifier/index']],
                ['label' => Yii::t('app', 'Race skills'), 'url' => ['/race-skill-proficiency/index']],
                ['label' => Yii::t('app', 'Race talents and features'), 'url' => ['/race-talent/index']],
                ['label' => Yii::t('app', 'Talents and features'), 'url' => ['/talent/index']],
                ['label' => Yii::t('app', 'Classes'), 'url' => ['/c-class/index']],
                ['label' => Yii::t('app', 'Class skills'), 'url' => ['/class-skill-proficiency/index']],
                ['label' => Yii::t('app', 'Character talent'), 'url' => ['/character-talent/index']],
                ['label' => Yii::t('app', 'Class talents and features'), 'url' => ['/class-talent/index']],
                ['label' => Yii::t('app', 'Proficiency bonus level rel'), 'url' => ['/proficiency-bonus-level-rel/index']],
                '<li class="dropdown-header">Class magic point (magic point, Known spells)</li>',
                ['label' => 'class_magic_point', 'url' => ['/class-magic-point/index']],
                '<li class="dropdown-header">Class magic level point (magic level point, Known spells level)</li>',
                ['label' => 'class_magic_level_point', 'url' => ['/class-magic-level-point/index']],
                '<li class="divider"></li>',
                '<li class="dropdown-header">' . Yii::t('app', 'Character') . '</li>',
                ['label' => Yii::t('app', 'Characters'), 'url' => ['/character/index']],
                '<li class="dropdown-header">' . Yii::t('app', 'Character class') . '</li>',
                ['label' => Yii::t('app', 'Character class'), 'url' => ['/character-class/index']],
                '<li class="dropdown-header">' . Yii::t('app', 'Character ability') . '</li>',
                ['label' => Yii::t('app', 'Character ability'), 'url' => ['/character-ability/index']],
                ['label' => Yii::t('app', 'Character skill'), 'url' => ['/character-skill/index']],
            ],
        ];

        $menuItems[] = [
            'label' => Yii::t('app', 'Maps'),
            'items' => [
                ['label' => Yii::t('app', 'Maps'), 'url' => ['/map/index']],
                ['label' => Yii::t('app', 'Map markers'), 'url' => ['/map_markers/index']],
                ['label' => Yii::t('app', 'Tokens'), 'url' => ['/token/index']]
            ]
        ];


    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
