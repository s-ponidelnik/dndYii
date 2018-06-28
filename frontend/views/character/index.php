<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Characters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Character'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'race_id',
                'value' => function ($data) {
                    return $data->race->_fullname;
                }
            ],
            'hp',
            'max_hp',
            'exp',
            'level',
            [
                'attribute' => 'exp_level',
                'value' => function ($data) {
                    return $data->getCharacterExpLevel();
                },
            ],
            [
                'attribute' => 'party',
                'format' => 'raw',
                'value' => function ($data) {
                    $list = [];
                    $party_leader = \common\models\CharacterParty::find()->where(['character_id' => $data->id, 'party_leader' => 1])->all();
                    foreach ($party_leader as $party) {
                        $list[]= Html::a($party->party_identifier, \yii\helpers\Url::to(['character/view-party','id'=>$party->party_identifier]),['target'=>'_blank']);
                    }
                    return implode(Html::tag('br'),$list);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
