<?php
echo \yii\helpers\Html::tag('h1',\yii\helpers\Html::a($model->_name,\yii\helpers\Url::to(['full_view_races/view','id'=>$model->id])));
