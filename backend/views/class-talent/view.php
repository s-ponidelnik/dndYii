<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ClassTalent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Class Talents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-talent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'class_id',
                'value' => function ($data) {
                    return $data->class->_name;
                }
            ],
            [
                'attribute' => 'talent_id',
                'value' => function ($data) {
                    if (!empty($data->talent->property))
                        return $data->talent->_name.'('.$data->talent->property.')';
                    return $data->talent->_name;
                }
            ],
            'property',
            'level',
        ],
    ]) ?>

</div>
