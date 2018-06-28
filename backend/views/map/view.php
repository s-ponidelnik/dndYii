<?php
use backend\assets\FullMapAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;
FullMapAsset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\Map */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$marker_model = new \common\models\MapMarkers();

?>

<input type="hidden" id="get-ajax-balloons-url" value="<?=\yii\helpers\Url::to(['map_markers/get','id'=>$model->id])?>">
<?php $img_size = getimagesize(Yii::$app->params['uploadsUrl'].'/'.$model->img_name)[3];?>
<div id="addBalloonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content">
            <?= $this->render('../map_markers/_form', [
                'model' => $marker_model,
            ]) ?>
        </div>

    </div>
</div>
    <div id="infoModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Modal Header</h4>
                    <p id="modal-submap-item">Map#<a href="" target="_blank" id="modal-submap-link"></a></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id='modal-body'>
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


        <div id='ctrl-buttons' style='z-index:50;position:fixed;margin-top:10%;padding:10px;'>
            <div style='background-image: url(http://uploads.dnd/back.png);background-color:gray;text-align:center;border-radius:25px;margin:5px;padding-top:15px;padding-bottom:20px;'>
                <i class="btn ctr-btn search-ctrl glyphicon glyphicon-search"></i></br></br></br>
                <i class="btn ctr-btn glyphicon glyphicon-plus"></i></br></br></br>
                <i class="btn ctr-btn glyphicon glyphicon-exclamation-sign"></i></br></br></br>
                <i class="btn ctr-btn debug-ctrl glyphicon glyphicon-cog"></i></br></br></br>
                <i class="btn ctr-btn grab-ctrl glyphicon glyphicon-fullscreen "></i></br></br></br>
                <i class="btn ctr-btn add-balloon glyphicon  glyphicon-plus-sign"></i>
            </div>
        </div>
<div id='map_container' class='noselect' style='position: relative;display:block;overflow:scroll;width:100%;height:100%;'>
        <img id='map' data-id="<?=$model->id;?>" class='noselect' src='<?=Yii::$app->params['uploadsUrl'].'/'.$model->img_name;?>' <?=$img_size;?> style='position:absolute;top:0px;z-index:1;'>
        <canvas id='labels' <?=$img_size;?> style='position:absolute;top:0px;z-index:2;display:none;'></canvas>
        <canvas id='icons' <?=$img_size;?> style='position:absolute;top:0px;z-index:3;'></canvas>
    </div>


