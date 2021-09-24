<?php
$templateDebug = false;
$addonName = 'redaxo_custom_components';
$globalSettings = CM_Global_Request_Settings::getInstance();
// rex_addon::get($addonName)->setConfig($modul, false);
// rex_config::get($addonName, $modul);


$curArtikel = rex_article::getCurrent();
$curArtikelId = -1;
if ($curArtikel !== null) {
    $curArtikelId = $curArtikel->getId();
}
