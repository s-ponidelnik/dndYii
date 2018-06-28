<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterTalent */

$this->title = Yii::t('app', 'Create Character Talent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Talents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-talent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
