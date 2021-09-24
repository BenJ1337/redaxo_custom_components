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
            <div class="form-group">
                <?php
                $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
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
    </div>
    <div id="nested" class="tab-pane fade">
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