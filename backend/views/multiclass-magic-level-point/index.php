<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MulticlassMagicLevelPointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Multiclass Magic Level Points');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multiclass-magic-level-point-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Multiclass Magic Level Point'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $spellInfo = [];
    $maxSpellLevel = 0;
    /** @var \common\models\ClassMagicLevelPoint $model */
    foreach ($models as $model) {
        if ($model->spell_level > $maxSpellLevel)
            $maxSpellLevel = $model->spell_level;
        if (!isset($spellInfo[$model->level]))
            $spellInfo[$model->level] = [];
        if (!isset($spellInfo[$model->level][$model->spell_level]))
            $spellInfo[$model->level][$model->spell_level] = $model->spell_point;
        ksort($spellInfo[$model->level]);
    }
        print '<table border="1px;">';
        print '<th style="padding-left: 5px;padding-right: 5px;">level</th>';
        $c = 1;
        while ($c <= $maxSpellLevel) {
            print '<th style="padding-left: 5px;padding-right: 5px;">' . $c . '</th>';
            $c++;
        }
        foreach ($spellInfo as $level => $spellInfo2) {
            print '<tr>';
            print '<td style="padding-left: 5px;padding-right: 5px;">' . $level . '</td>';
            $c=1;
            while ($c <= $maxSpellLevel) {
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

    ?>
</div>
