<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Spell */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spells'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spell-view">

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
    <h1><?=$model->name;?></h1>
    <h2><?=Yii::t('app','{level} level',['level'=>$model->level]);?>,<?=$model->spell_property;?></h2>
    <h3><?=$model->overlay_time;?> <?=\common\models\Spell::getTimeTypeName($model->overlay_time_type)?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'level',
            'spell_property',
            'overlay_time',
            [
                'attribute' => 'overlay_time_type',
                'value' => \common\models\Spell::getTimeTypeName($model->overlay_time_type)

            ],
            'distance',
            'components',
            'duration_time',
            [
                'attribute' => 'duration_time_type',
                'value' => \common\models\Spell::getTimeTypeName($model->duration_time_type)
            ],
            'concentration',
            'description:ntext',
        ],
    ]) ?>

</div>
