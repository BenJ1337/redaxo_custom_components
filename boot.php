<?php
if (rex::isBackend()) {
    //$addon = rex_addon::get('redaxo_custom_components');
    rex_view::addJsFile($this->getAssetsUrl('vendor/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js'));
    rex_view::addCssFile($this->getAssetsUrl('vendor/fontawesome-iconpicker/dist/css/bootstrap-iconpicker.min.css'));
    // rex_view::addCssFile($addon->getAssetsUrl('frontend/slick-slider/slick.css'));
    // rex_view::addCssFile($addon->getAssetsUrl('frontend/slick-slider/slick-theme.css'));
    // rex_view::addCssFile($addon->getAssetsUrl('frontend/photoswipe.css'));
    // rex_view::addCssFile($addon->getAssetsUrl('frontend/fontawesome-free-5.11.2-web/css/fontawesome.min.css'));
    // rex_view::addCssFile($addon->getAssetsUrl('frontend/fontawesome-free-5.11.2-web/css/all.css'));
    // rex_view::addCssFile($addon->getAssetsUrl('frontend/highlightjs/default.min.css'));
}
