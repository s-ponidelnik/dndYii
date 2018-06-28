<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterSpellPoints */

$this->title = Yii::t('app', 'Create Character Spell Points');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Spell Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-spell-points-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
