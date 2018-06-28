<?php

use backend\assets\FullMap2Asset;
use yii\helpers\Html;
use yii\widgets\DetailView;

FullMap2Asset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\Map */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$marker_model = new \common\models\MapMarkers();
?>
    <input type="hidden" id="marker_pos_update_url" value="<?= \yii\helpers\Url::to(['map_markers/update_pos']); ?>">
    <input type="hidden" id="marker_delete_url" value="<?= \yii\helpers\Url::to(['map_markers/delete_marker']); ?>">
    <div class="modal fade" id="add-marker-modal" tabindex="-1" role="dialog"
         aria-labelledby="add-marker-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-marker-modalLabel">Add marker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $this->renderFile('@app/views/map_markers/modal_create.php', ['model' => $marker_model]) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php $img_size = getimagesize(Yii::$app->params['uploadsUrl'] . '/' . $model->img_name)[3]; ?>
    <div id='ctrl-buttons' style='z-index:1000;position:fixed;margin-top:10%;padding:10px;'>
        <div style='background-image: url(http://uploads.dnd/back.png);background-color:gray;text-align:center;border-radius:25px;margin:5px;padding-top:15px;padding-bottom:20px;'>
            <i class="btn ctr-btn search-ctrl glyphicon glyphicon-search"></i></br></br></br>
            <i class="btn ctr-btn glyphicon glyphicon-plus"></i></br></br></br>
            <i class="btn ctr-btn glyphicon glyphicon-exclamation-sign"></i></br></br></br>
            <i class="btn ctr-btn debug-ctrl glyphicon glyphicon-cog"></i></br></br></br>
            <i class="btn ctr-btn grab-ctrl glyphicon glyphicon-fullscreen "></i></br></br></br>
            <i class="btn ctr-btn distance-ctrl glyphicon glyphicon-fullscreen "></i></br></br></br>
            <i class="btn ctr-btn grid-ctrl glyphicon glyphicon-cog "></i></br></br></br>
            <i class="btn ctr-btn add-balloon glyphicon  glyphicon-plus-sign"></i>
        </div>
    </div>
    <div id='map_container' class='noselect'
         style='position: relative;display:block;overflow:scroll;width:100%;height:100%;'>

        <img id='map' data-id="<?= $model->id; ?>" class='noselect'
             src='<?= Yii::$app->params['uploadsUrl'] . '/' . $model->img_name; ?>' <?= $img_size; ?>
             style='position:absolute;top:0px;z-index:1;'>
        <canvas id='grid' <?= $img_size; ?> style='position:absolute;top:0px;z-index:90;'></canvas>
        <canvas id='distance' <?= $img_size; ?> style='position:absolute;top:0px;z-index:100;'></canvas>

        <?php foreach ($model->markers as $marker) { ?>
            <?php echo Html::tag(
                'span',
                Html::img('http://uploads.dnd/cavern.png', ['width' => '40px']) .
                Html::tag('p', $marker->name, ['style' => [
                    'font-size' => '25px',
                    'margin-left' => '28px',
                    'margin-top' => '-14px',
                    'font-weight' => 'bold',
                    'color'=>'white',
                    '-webkit-text-stroke'=>'1px #000',
                    'display'=>'none',
                ]]),
                [
                    'data-id' => $marker->id,
                    'id' => 'marker-' . $marker->id,
                    'class' => 'marker marker-link',
                    'data-toggle' => 'modal',
                    'data-target' => "#marker" . $marker->id . "Modal",
                    'style' => [
                        'padding' => '0px',
                        'margin' => '0px',
                        'z-index' => 100,
                        'position' => 'absolute',
                        'top' => $marker->pos_y . 'px',
                        'left' => $marker->pos_x . 'px'
                    ]]);

            ?>

        <?php } ?>

    </div>


    <!-- Button trigger modal -->


<?php
/** @var \common\models\MapMarkers $marker */
foreach ($model->markers as $marker) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="marker<?= $marker->id; ?>Modal" tabindex="-1" role="dialog"
         aria-labelledby="marker<?= $marker->id; ?>ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="marker<?= $marker->id; ?>ModalLabel"><?= $marker->name; ?></h5>

                    <a href='http://backend.dnd/index.php?r=map%2Fview&id=<?= $marker->sub_map_id; ?>' target="_blank">http://backend.dnd/index.php?r=map%2Fview&id=<?= $marker->sub_map_id; ?></a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $marker->description; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>