<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">Einstellungen</a></li>
    <li><a data-toggle="tab" href="#nested">Breite</a></li>
</ul>
<div class="tab-content">
    <div id="general" class="tab-pane fade in active">
        <div class="form-group">
            <?php
            $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
            $bildauswahl = new Bildauswahl(
                "Bild",
                2,
                ['bild'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            $bildauswahl->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $dropDown = new DropDown(
                'Höhe',
                2,
                ['hoehe'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null,
                array(
                    "50" => "50",
                    "100" => "100",
                    "200" => "200",
                    "150" => "150",
                    "300" => "300",
                    "500" => "500",
                    "600" => "600"
                )
            );
            $dropDown->setDefaultValue("200");
            echo $dropDown->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
            $wysiwygEditor = new WYSIWYGEditor(
                "optionaler Text",
                2,
                ['wasiwyg_text'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            $wysiwygEditor->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $dropDown = new DropDown(
                'Textfarbe',
                2,
                ['textfarbe'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null,
                array(
                    "Weiß" => "#fff",
                    "Schwart" => "#000"
                )
            );
            $dropDown->setDefaultValue("200");
            echo $dropDown->getHTML();
            ?>
        </div>
    </div>
    <div id="nested" class="tab-pane fade">
        <div class="form-group">
            <?php
            $bootstrapFormBuilder = new CM_BootstrapFormBuilder($slice);
            $bootstrapFormBuilder->withLgWidth('12');
            $bootstrapFormBuilder->withMdWidth('12');
            $bootstrapFormBuilder->withSmWidth('12');
            $bootstrapFormBuilder->withXsWidth('12');
            echo $bootstrapFormBuilder->build();
            ?>
        </div>
    </div>
</div>