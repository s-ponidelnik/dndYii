<?php

use kartik\sortable\Sortable;
use common\widgets\items\CharacterItemsWidget;

\common\widgets\items\assets\ItemsAsset::register($this);
/** @var $item \common\models\CharacterItems */
if (empty($items)) {
    ?>
    <span class="disabled-info-text-label">Пусто</span>
    <?php

}
?>

<ul class="list-unstyled character-items-widget-block">
    <?php
    foreach ($items as $item) {
            ?>
            <li class="character-items-widget-element">
            <a class="character-items-widget-name <?= ($item->item->packable ? 'packable' : '') ?>"
               data-toggle="collapse"
               href="#collapseItem<?= $item->id; ?>"
               role="button" aria-expanded="false"
               aria-controls="collapseItem<?= $item->id; ?>">
                <?php if ($item->count>1) { ?>
                    <span class="badge character-item-badge-count"><?=$item->count;?></span>
                <?php } ?>
                <?= $item->item->name; ?> <?php if (!empty($item->item->short_description)) { ?><span
                    class="glyphicon glyphicon-question-sign item-info-icon" data-toggle="tooltip"
                    title="<?= strip_tags($item->item->short_description); ?>"></span><?php } ?>
            </a>
            <?php
            if ($item->item->packable) {
                ?>
                <div class="collapse character-items-widget-sub-items-block" id="collapseItem<?= $item->id; ?>">
                    <div class="sub-items-block">
                        <?php
                        echo CharacterItemsWidget::widget(['items' => $item->itemsIn]);
                        ?>
                    </div>
                </div>
                <?php
            }
            ?></li><?php
    }
    ?>
</ul>
