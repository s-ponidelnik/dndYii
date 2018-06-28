<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterSkill */

$this->title = Yii::t('app', 'Create Character Skill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-skill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
