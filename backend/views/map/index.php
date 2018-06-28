<?php
use backend\assets\MapAsset;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\sortable\Sortable;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
MapAsset::register($this);
$this->title = Yii::t('app', 'Maps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Map'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_map',
    ]);?>
    <?php Pjax::end(); ?>
</div>
