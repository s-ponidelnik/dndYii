<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NoteTag */

$this->title = Yii::t('app', 'Create Note Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Note Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
