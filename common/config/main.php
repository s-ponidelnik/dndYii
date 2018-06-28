<?php
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [

    ],
    'components' => [
        'socket'=>[
            'class'=>'common\components\Socket'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/msgs',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/items' => 'items.php',
                        'app/classes' => 'classes.php',
                        'app/currency' => 'currency.php',
                        'app/ability' => 'ability.php',
                        'app/skill' => 'skill.php',
                        'app/damage' => 'damage.php',
                        'app/condition' => 'condition.php',
                        'app/tools' => 'tools.php',
                        'app/talents' => 'talents.php',
                        'app/race' => 'race.php',
                    ],
                ],
            ],
        ],
    ],
];
