<form style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">
    <fieldset>
        <?php
        include __DIR__ . '/../lib/Constants.php';


        $impressumId = null;
        $datenschutzId = null;
        if (isset($_POST[IMPRESSUM_KEY])) {
            $impressumId = $_POST[IMPRESSUM_KEY];
            $datenschutzId = $_POST[DATENSCHUTZ_KEY];
        }
        ?>

        <div class="form-group">
            <label for="<?= IMPRESSUM_KEY ?>">Seite für das Impressum
                <?= rex_var_link::getWidget(IMPRESSUM_KEY, "Impressum",  $impressumId, []); ?>
            </label>
        </div>
        <div class="form-group">
            <label for="<?= DATENSCHUTZ_KEY ?>">Seite für den Datenschutz
                <?= rex_var_link::getWidget(DATENSCHUTZ_KEY, "Datenschutz",  $datenschutzId, []); ?>
            </label>
        </div>
        <button type="submit" class="btn btn-success">
            Übernehmen
        </button>
    </fieldset>
</form>