<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterClass */

$this->title = Yii::t('app', 'Create Character Class');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
