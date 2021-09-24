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
            $wysiwygEditor = new WYSIWYGEditor(
                "Text",
                2,
                ['wasiwyg_text'],
                $slice != null ? rex_var::toArray($slice->getValue(2)) : null
            );
            $wysiwygEditor->getHTML();
            ?>
        </div>
    </div>
    <div id="nested" class="tab-pane fade">
        <?php
        $bootstrapFormBuilder = new CM_BootstrapFormBuilder($slice);
        echo $bootstrapFormBuilder->build();
        ?>
        <div class="form-group">
            <?php
            $checkbox = new Checkbox(
                "Einrückung links/rechts",
                1,
                ["padding"],
                $slice != null ? rex_var::toArray($slice->getValue(1)) : null,
                '1'
            );
            echo $checkbox->getHTML();
            ?>
        </div>
    </div>
</div>