<?php
rex_addon::get("redaxo_custom_components")->setConfig("highlightjs", true);
$globalSettings = CM_Global_Request_Settings::getInstance();
$globalSettings->setHighlightjs(true);

$rex_values_settings = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);

$outputBuilder = new CM_OutputBuilder(
    $rex_values_settings[BootstrapColWidth::lg],
    $rex_values_settings[BootstrapColWidth::md],
    $rex_values_settings[BootstrapColWidth::sm],
    $rex_values_settings[BootstrapColWidth::xs]
);

$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(2), true);

$htmlOutput = '';
$htmlOutput = '<pre><code>' . htmlspecialchars($rex_values_content['code']) . '</code></pre>';


$outputBuilder->withFrontendOutput($htmlOutput);

echo $outputBuilder->build();

if (rex::isBackend()) {
    echo '<script src="/assets/addons/custommodules/frontend/highlightjs/highlight.min.js"></script>
            <link rel="stylesheet" href="/assets/addons/custommodules/frontend/highlightjs/default.min.css">
            <script>hljs.initHighlightingOnLoad();</script>';
}
