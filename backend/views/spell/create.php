<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Spell */

$this->title = Yii::t('app', 'Create Spell');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spells'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spell-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
