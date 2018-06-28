<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CharacterTalentUsed */

$this->title = Yii::t('app', 'Create Character Talent Used');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Character Talent Useds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-talent-used-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
