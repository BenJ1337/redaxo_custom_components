<h1>Custom Modul</h1>

<?php
function countUsagesOfModules()
{
    $sql = rex_sql::factory();
    $sql->setQuery("SELECT module_id FROM rex_article_slice");
    $module_ids_results = $sql->getDBArray();
    $module_ids = array();
    foreach ($module_ids_results as $module_ids_result) {
        $val = 1;
        if (isset($module_ids[$module_ids_result['module_id']])) {
            $val = $module_ids[$module_ids_result['module_id']] + 1;
        }
        $module_ids[$module_ids_result['module_id']] = $val;
    }
    return $module_ids;
}

function getModulesFromDB($user)
{
    $sql = rex_sql::factory();
    $sql->setQuery("SELECT * FROM rex_module " . ($user != null ? "WHERE createuser = '" . $user . "'" : ""));
    return $sql->getDBArray();
}

function getTemplatesFromDB($user)
{
    $sql = rex_sql::factory();
    $sql->setQuery("SELECT * FROM rex_template " . ($user != null ? "WHERE createuser = '" . $user . "'" : ""));
    return $sql->getDBArray();
}

if (isset($_POST["copy_modules_from_database"]) || isset($_POST["archive_modules_from_database"])) {
    $modules = getModulesFromDB(null);

    $rexModulesPath = 'rex_modules';
    $subPath = 'work';
    if (isset($_POST["archive_modules_from_database"])) {
        $subPath = 'archive/' . date("Y_m_s - H_i_s", time());
    }
    if (!isset($_POST["archive_modules_from_database"])) {
        rex_dir::deleteFiles(
            rex_path::addon('redaxo_custom_components', '/' . $rexModulesPath . '/' . $subPath)
        );
    }

    foreach ($modules as $module) {
        $filename = $module['id'] . '-' . $module['name'] . '.json';
        rex_dir::create(
            rex_path::addon('redaxo_custom_components', $rexModulesPath . '/' . $subPath)
        );
        rex_file::put(
            rex_path::addon('redaxo_custom_components', '/' . $rexModulesPath . '/' . $subPath . '/' . $filename),
            json_encode($module)
        );
    }
    $html = '<div class="alert alert-success">'
        . '<p>'
        . (isset($_POST["archive_modules_from_database"]) ? 'Archivierung erfolgreich' : 'Kopieren erfolgreich')
        . '</p> '
        . '</div>';
    echo $html;
}

if (isset($_POST["copy_templates_from_database"]) || isset($_POST["archive_templates_from_database"])) {
    $templates = getTemplatesFromDB(null);

    $rexModulesPath = 'rex_templates';
    $subPath = 'work';
    if (isset($_POST["archive_templates_from_database"])) {
        $subPath = 'archive/' . date("Y_m_s - H_i_s", time());
    }
    if (!isset($_POST["archive_templates_from_database"])) {
        rex_dir::deleteFiles(
            rex_path::addon('redaxo_custom_components', '/' . $rexModulesPath . '/' . $subPath)
        );
    }

    foreach ($templates as $template) {
        $filename = $template['id'] . '-' . $template['name'] . '.json';
        rex_dir::create(
            rex_path::addon('redaxo_custom_components', $rexModulesPath . '/' . $subPath)
        );
        rex_file::put(
            rex_path::addon('redaxo_custom_components', '/' . $rexModulesPath . '/' . $subPath . '/' . $filename),
            json_encode($template)
        );
    }
    $html = '<div class="alert alert-success">'
        . '<p>'
        . (isset($_POST["archive_modules_from_database"]) ? 'Archivierung erfolgreich' : 'Kopieren erfolgreich')
        . '</p> '
        . '</div>';
    echo $html;
}

function isModuleAlreadyInDB($modulesFromDB, $curModule)
{
    foreach ($modulesFromDB as $module) {
        if (
            $module['name'] === $curModule['name']
        ) {
            print_r('>>' . sizeof(array_diff($module, $curModule)));
            if (sizeof(array_diff($module, $curModule)) < 3) {
                return true;
            }
        }
    }
    return false;
}

if (isset($_POST["copy_modules_to_database"])) {
    $error = false;

    $sql = rex_sql::factory();
    $rexModulesPath = 'rex_modules';
    $subPath = 'work';
    $directory = rex_path::addon('redaxo_custom_components', '/' . $rexModulesPath . '/' . $subPath . '/');
    $module_paths = glob($directory . "*.json");
    $modulesFromDB = getModulesFromDB('redaxo_custom_components');
    $index = 0;
    $messagesInfo = array();
    $messagesWarning = array();
    $messagesError = array();
    foreach ($module_paths as $module_path) {
        $file = rex_file::get($module_path);
        if ($file == null) {
            array_push($messagesError, 'Datei nicht gefunden: "' . $module_path . '"');
        }
        $module = json_decode($file, true);
        if (
            isModuleAlreadyInDB($modulesFromDB, $module)
        ) {
            array_push($messagesWarning, 'Modul "' . $module['name'] . '" bereits in Datenbank');
        } else {
            $module['createuser'] = 'redaxo_custom_components';
            array_push($messagesInfo, 'Modul "' . $module['name'] . '" der Datenbank erfolgreich hinzugefügt');
            unset($module['id']);
            $sql->setTable("rex_module");
            $sql->setValues($module);
            $index += $sql->insert()->getRows();
        }
    }
    $html = '';
    if (sizeof($messagesInfo) > 0) {
        $html .= '<div class="alert alert-success' . '">';
        foreach ($messagesInfo as $m) {
            $html .= '<p>' . $m . '</p>';
        }
        $html .= '</div>';
    }
    if (sizeof($messagesWarning) > 0) {
        $html .= '<div class="alert alert-warning' . '">';
        foreach ($messagesWarning as $m) {
            $html .= '<p>' . $m . '</p>';
        }
        $html .= '</div>';
    }
    if (sizeof($messagesError) > 0) {
        $html .= '<div class="alert alert-danger' . '">';
        foreach ($messagesError as $m) {
            $html .= '<p>' . $m . '</p>';
        }
        $html .= '</div>';
    }
    echo $html;
}
if (isset($_POST["delete_modules_from_database"])) {
    $modules = getModulesFromDB('redaxo_custom_components');
    $moduleUsages = countUsagesOfModules();
    $messages = array();
    $result = 0;
    foreach ($modules as $module) {
        if (isset($moduleUsages[$module['id']])) {
            array_push($messages, 'Modul "' . $module['name'] . '" (' . $module['id'] . ') nicht gelöscht, da ' . $moduleUsages[$module['id']] . ' Mal in Benutzung.');
        } else {
            $sql = rex_sql::factory();
            $sql->setTable("rex_module");
            $sql->setWhere("createuser =:user AND id =:mid", ["user" => "redaxo_custom_components", "mid" => $module['id']]);
            $result += $sql->delete()->getRows();
        }
    }
    $html = '<div class="alert alert-' . ($result > 0 ? 'success' : 'warning') . '">'
        . '<p>'
        . ($result > 0 ? $result . ' Module erfolgreich aus Datenbank gelöscht.' . $result : 'Es wurden keine Module aus der Datenbank entfernt.')
        . '</p> '
        . '</div>';
    if (sizeof($messages) > 0) {
        $html .= '<div class="alert alert-warning' . '">';
        foreach ($messages as $m) {
            $html .= '<p>' . $m . '</p>';
        }
        $html .= '</div>';
    }
    echo $html;
}
?>

<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="post">
    <fieldset>
        <legend>Modules:</legend>
        <div class="form-group">
            <button name="copy_modules_from_database" type="submit" class="btn btn-success">
                Modules aus Datenbank kopieren
            </button>
        </div>
        <div class="form-group">
            <button name="archive_modules_from_database" type="submit" class="btn btn-success">
                Modules aus Datenbank archivieren
            </button>
        </div>
        <div class="form-group">
            <button name="copy_modules_to_database" type="submit" class="btn btn-success">
                Modules in Datenbank kopieren
            </button>
        </div>
        <div class="form-group">
            <button name="delete_modules_from_database" type="submit" class="btn btn-danger">
                Modules aus Datenbank löschen
            </button>
        </div>
    </fieldset>
    <fieldset>
        <legend>Templates:</legend>
        <div class="form-group">
            <button name="copy_templates_from_database" type="submit" class="btn btn-success">
                Templates aus Datenbank kopieren
            </button>
        </div>
        <div class="form-group">
            <button name="archive_templates_from_database" type="submit" class="btn btn-success">
                Templates aus Datenbank archivieren
            </button>
        </div>
    </fieldset>
</form>

<?php  include 'manageGlobalLinks.php'; ?>

<fieldset>
    <legend>Meta Info Einstellungen:</legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Prefix</th>
                <th>Spaltenname</th>
                <th>Feldbezeichnung</th>
                <th>Parameter</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>art_</td>
                <td>website_title</td>
                <td>Webseiten Titel</td>
                <td>text</td>
            </tr>
            <tr>
                <td>art_</td>
                <td>description</td>
                <td>Beschreibung</td>
                <td>textarea</td>
            </tr>
            <tr>
                <td>art_</td>
                <td>onepage_main</td>
                <td>Onepage Hauptseite</td>
                <td>REX_LINK_WIDGET</td>
            </tr>
        </tbody>
    </table>
</fieldset>