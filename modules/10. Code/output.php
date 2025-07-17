<?php

use redaxo_bootstrap\{CM_Global_Request_Settings,CM_OutputBuilder,BootstrapColWidth};

rex_addon::get("redaxo_custom_components")->setConfig("highlightjs", true);
$globalSettings = CM_Global_Request_Settings::getInstance();
$globalSettings->setHighlightjs(true);

$slice = rex_article_slice::getArticleSliceById($sliceId);

$rex_values_settings = json_decode($slice->getValue(1), true);

$outputBuilder = new CM_OutputBuilder(
    $rex_values_settings[BootstrapColWidth::lg],
    $rex_values_settings[BootstrapColWidth::md],
    $rex_values_settings[BootstrapColWidth::sm],
    $rex_values_settings[BootstrapColWidth::xs],
    $sliceId
);

$rex_values_content = json_decode($slice->getValue(2), true);

$htmlOutput = '';
$htmlOutput = '<pre><code>' . htmlspecialchars($rex_values_content['code']) . '</code></pre>';


$outputBuilder->withFrontendOutput($htmlOutput);

echo $outputBuilder->build();

if (rex::isBackend()) {
    echo '<script src="/assets/addons/redaxo_custom_components/frontend/highlightjs/highlight.min.js"></script>
            <link rel="stylesheet" href="/assets/addons/redaxo_custom_components/frontend/highlightjs/default.min.css">
            <script>hljs.initHighlightingOnLoad();</script>';
}
