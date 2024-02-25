<?php
$sliceId = -1;
if (null !== $this->sliceSql) {
    $sliceId = $this->getCurrentSlice()->getId();
}
?>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">Einstellungen</a></li>
    <li><a data-toggle="tab" href="#nested">Breite</a></li>
</ul>
<div class="tab-content">
    <div id="general" class="tab-pane fade in active">
        <div class="form-group">
            <div class="rex-js-widget rex-js-widget-medialist">
                <div class="input-group">
                    <?php
                    $mehrfachbildauswahl = new MehrfachBildauswahl(
                        "Bilder",
                        ['bilder'],
                        $sliceId,
                        2,
                    );
                    echo $mehrfachbildauswahl->getHTML();
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php
            $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
            $slideSpeedInput = new Inputfield(
                "Anzeigedauer",
                2,
                ["speed"],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            echo $slideSpeedInput->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $checkbox = new Checkbox("Punkte", ["dots"], $sliceId, 2, 'true');
            echo $checkbox->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $checkbox = new Checkbox("Unendliches Scrollen", ["infinity"], $sliceId, 2, 'true');
            echo $checkbox->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $checkbox = new Checkbox("Pfeile",  ["arrows"], $sliceId, 2, 'true');
            echo $checkbox->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $checkbox = new Checkbox("Verblassen-Effekt",  ["fade"], $sliceId, 2, 'true');
            echo $checkbox->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $checkbox = new Checkbox("Stop bei Mouseover", ["stop_on_mouseover"], $sliceId, 2, 'true');
            echo $checkbox->getHTML();
            ?>
        </div>
    </div>
    <div id="nested" class="tab-pane fade">
        <?php
        $bootstrapFormBuilder = new CM_BootstrapFormBuilder($slice);
        echo $bootstrapFormBuilder->build();
        ?>
    </div>
</div>