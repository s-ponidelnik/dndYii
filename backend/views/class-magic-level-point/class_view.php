<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $models yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Class Magic Level Points');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-magic-level-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Create Class Magic Level Point'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $classes = [];
    $maxSpellLevels = [];
    /** @var \common\models\ClassMagicLevelPoint $model */
    foreach ($models as $model) {
        if (!isset($maxSpellLevels[$model->class->_name]))
        $maxSpellLevels[$model->class->_name]=0;
        if ($model->spell_level > $maxSpellLevels[$model->class->_name])
            $maxSpellLevels[$model->class->_name] = $model->spell_level;
        if (!isset($classes[$model->class->_name]))
            $classes[$model->class->_name] = [];
        if (!isset($classes[$model->class->_name][$model->level]))
            $classes[$model->class->_name][$model->level] = [];
        if (!isset($classes[$model->class->_name][$model->level][$model->spell_level]))
            $classes[$model->class->_name][$model->level][$model->spell_level] = $model->spell_point;
        ksort($classes[$model->class->_name][$model->level]);
    }
    foreach ($classes as $class => $spellInfo) {
        print Html::tag('h1', $class);
        print '<table border="1px;">';
        print '<th style="padding-left: 5px;padding-right: 5px;">level</th>';
        $c = 1;
        while ($c <= $maxSpellLevels[$class]) {
            print '<th style="padding-left: 5px;padding-right: 5px;">' . $c . '</th>';
            $c++;
        }
        foreach ($spellInfo as $level => $spellInfo2) {
            print '<tr>';
            print '<td style="padding-left: 5px;padding-right: 5px;">' . $level . '</td>';
            $c=1;
            while ($c <= $maxSpellLevels[$class]) {
                print '<td style="padding-left: 5px;padding-right: 5px;">';
                if (isset($spellInfo2[$c]))
                print $spellInfo2[$c];
                else
                    print '-';
                print '</td>';
                $c++;
            }
            print '</tr>';
        }
        print '<table>';
    }
    ?>
</div>
