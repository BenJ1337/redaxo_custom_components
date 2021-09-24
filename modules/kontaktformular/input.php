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
            <fieldset>
                <legend>Anschrift:</legend>
                <div class="form-group">
                    <?php
                    $slice = rex_article_slice::getArticleSliceById($rex_slice_id);
                    $anschriftNameInput = new InputField(
                        "Name",
                        2,
                        ["anschrift_name"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $anschriftNameInput->getHTML();
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $anschriftStrasseInput = new InputField(
                        "Straße und Hausnummer",
                        2,
                        ["anschrift_str_hnr"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $anschriftStrasseInput->getHTML();
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $anschriftPlzOrtInput = new InputField(
                        "PLZ und Ort",
                        2,
                        ["anschrift_plz_ort"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $anschriftPlzOrtInput->getHTML();
                    ?>
                </div>
            </fieldset>
        </div>
        <div class="form-group">
            <fieldset>
                <legend>Bürozeiten:</legend>
                <div class="form-group">
                    <?php
                    $bueorZeitenMoDoInput = new InputField(
                        "Bürozeit von Mo bis Do",
                        2,
                        ["bueroZeitMoDo"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $bueorZeitenMoDoInput->getHTML();
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $bueorZeitenFrInput = new InputField(
                        "Bürozeit am Fr",
                        2,
                        ["bueroZeitFr"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $bueorZeitenFrInput->getHTML();
                    ?>
                </div>
            </fieldset>
        </div>
        <div class="form-group">
            <fieldset>
                <legend>Kontakt:</legend>
                <div class="form-group">
                    <?php
                    $kontaktTelInput = new InputField(
                        "Telefon",
                        2,
                        ["kontaktTelInput"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo  $kontaktTelInput->getHTML();
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $kontaktFaxInput = new InputField(
                        "Fax",
                        2,
                        ["kontaktFaxInput"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $kontaktFaxInput->getHTML();
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $emailInput = new InputField(
                        "E-Mail",
                        2,
                        ["target_email_address"],
                        $slice != null ? rex_var::toArray($slice->getValue(2)) : null
                    );
                    echo $emailInput->getHTML();
                    ?>
                </div>
            </fieldset>
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