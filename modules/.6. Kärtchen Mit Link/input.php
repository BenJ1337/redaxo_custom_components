<ul class="nav nav-tabs">
    <li class="active">
        <a data-toggle="tab" href="#general">Einstellungen</a>
    </li>
    <li>
        <a data-toggle="tab" href="#nested">Breite</a>
    </li>
</ul>

<div class="tab-content">
    <div id="general" class="tab-pane fade in active">
        <div class="form-group">
            <?php
            $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
            $iconPicker = new IconPicker(
                "Icon",
                2,
                ['icon'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            $iconPicker->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $title = new Inputfield(
                "title",
                2,
                ['title'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            echo $title->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
            $text = new Textarea(
                "text",
                2,
                ['text'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            echo $text->getHTML();
            ?>
        </div>
        <div class="form-group">
            <?php
            $linkauswahl = new Linkauswahl(
                "Verlinkter Artikel",
                2,
                ['link'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            echo $linkauswahl->getHTML();
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