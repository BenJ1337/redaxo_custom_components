<?php

use redaxo_url_rewrite\URLManager;

$servername = rex::getServerName();
$htmlTitle = '';
$subdirectory = '/';
if (class_exists('redaxo_url_rewrite\URLManager')) {
    $subdirectory = URLManager::getSubdirectory();
}

$title = rex_article::getCurrent()->getValue('art_website_title');
if (isset($title) && !empty($title)) {
    echo "<title>" . $title . "</title>";
} else {
    echo "<title>" . $servername . ' - ' . rex_article::getCurrent()->getName() . "</title>";
}
?>
<meta charset="UTF-8">
<?php
$metaDescription = rex_article::getCurrent()->getValue('art_description');
if (isset($metaDescription) && !empty($metaDescription)) {
    echo '<meta name="description" content="' . $metaDescription . '">';
}
?>

<meta name="author" content="Benjamin Hacker">
<link rel="icon" type="image/png" href="/custom/favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1">


<?php
if (isset($templateDebug) && $templateDebug == true) {
    echo '<script src="'
    . $subdirectory
        . 'rexsources/dev/script.js"></script>';
} else {
    echo '<script src="'
    . $subdirectory
        . 'rexsources/script.js"></script>';
}
if ($globalSettings->isSlickslider()) {
    echo '<link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/slick-slider/slick.css">
            <link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/slick-slider/slick-theme.css">';
}
if ($globalSettings->isPhotoswipe()) {
    echo '<link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/photoswipe.css">
            <link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/default-skin/default-skin.css">';
}
if ($globalSettings->isFontawesome()) {
    echo '<link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/fontawesome-free-5.11.2-web/css/fontawesome.min.css">
            <link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/fontawesome-free-5.11.2-web/css/all.css">';
}
if ($globalSettings->isHighlightjs()) {
    echo '<link rel="stylesheet" href="/assets/addons/' . $addonName . '/frontend/highlightjs/default.min.css">';
}


echo '<link rel="stylesheet" href="' . $subdirectory . rex_addon::get('redaxo_custom_components')->getAssetsUrl('/frontend/bootstrap_5/bootstrap.min.css').'">';
echo '<script src="'. $subdirectory . rex_addon::get('redaxo_custom_components')->getAssetsUrl('/frontend/bootstrap5/bootstrap.bundle.min.js').'"></script>';


?>