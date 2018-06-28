<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterParty */

$this->title = Yii::t('app', 'Create Character Party');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Parties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-party-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
