<?php
$globalSettings = CM_Global_Request_Settings::getInstance();
$globalSettings->setFontawesome(true);
$rex_values_settings = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);

$outputBuilder = new CM_OutputBuilder(
  $rex_values_settings[BootstrapColWidth::lg],
  $rex_values_settings[BootstrapColWidth::md],
  $rex_values_settings[BootstrapColWidth::sm],
  $rex_values_settings[BootstrapColWidth::xs]
);

$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(2), true);

$icon = '';
if (isset($rex_values_content['icon'])) {
  $icon = $rex_values_content['icon'];
}
$title = '';
if (isset($rex_values_content['title'])) {
  $title = $rex_values_content['title'];
}
$text = '';
if (isset($rex_values_content['text'])) {
  $text = $rex_values_content['text'];
}
$link = '';
if (isset($rex_values_content['link']) && !empty($rex_values_content['link'])) {
  $link = rex_getUrl($rex_values_content['link']);
}

$htmlOutput = '<div class="card kaetchen-mit-link">
  <div class="card-body">
    <i class="' . $icon . '"></i>
    <div class="wrapper"><h4 class="card-title">' . $title . '</h4>
    <p class="card-text">' . $text . '</p></div>';
if (!empty($link)) {
  $htmlOutput .= '<a href="' . $link . '" class="card-link">weiterlesen</a>';
}
$htmlOutput .= '</div>
</div>';


$outputBuilder->withFrontendOutput($htmlOutput);

echo $outputBuilder->build();
