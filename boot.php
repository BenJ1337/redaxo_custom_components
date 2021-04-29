<?php
if (rex::isBackend()) {
    $addon = rex_addon::get('redaxo_custom_components');
    rex_view::addCssFile($addon->getAssetsUrl('redaxo_custom_components.css'));
}
