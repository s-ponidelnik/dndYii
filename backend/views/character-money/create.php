<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterMoney */

$this->title = Yii::t('app', 'Create Character Money');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-money-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
