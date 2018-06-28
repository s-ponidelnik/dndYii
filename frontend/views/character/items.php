<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\items\CharacterItemsWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\Character */
$this->title = Yii::t('app', 'Characters');
$this->params['breadcrumbs'][] = $this->title;
echo CharacterItemsWidget::widget(['items' => $model->mainItems]);
?>
