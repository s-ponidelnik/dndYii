<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterItems */

$this->title = Yii::t('app', 'Create Character Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
