<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Ability */

$this->title = Yii::t('app', 'Create Ability');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Abilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ability-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
