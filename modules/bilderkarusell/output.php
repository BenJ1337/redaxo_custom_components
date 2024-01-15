<?php
//rex_article_content:: getContentAsQuery(true) -> SQL Queries erlauben
$this->getContentAsQuery(true);
$slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());

$globalSettings = CM_Global_Request_Settings::getInstance();
$globalSettings->setSlickslider(true);


$rex_values_settings = json_decode($slice->getValue(1), true);
$rex_values_content = json_decode($slice->getValue(2), true);
if (rex::isBackend()) {
    echo '<div class="panel panel-default"><div class="panel-heading">'
        . rex_i18n::msg('cm_slice_settings')
        . '</div><div class="panel-body">'
        . '<div>' . rex_i18n::msg('cm_bootstrap_grid_large') . ' <span class="badge">' . $rex_values_settings["bootstrap_column_width_lg"] . '</span></div>'
        . '<div>' . rex_i18n::msg('cm_bootstrap_grid_medium') . ' <span class="badge">' . $rex_values_settings["bootstrap_column_width"] . '</span></div>'
        . '<div>' . rex_i18n::msg('cm_bootstrap_grid_small') . ' <span class="badge">' . $rex_values_settings["bootstrap_column_width_sm"] . '</span></div>'
        . '<div>' . rex_i18n::msg('cm_bootstrap_grid_extra_small') . ' <span class="badge">' . $rex_values_settings["bootstrap_column_width_xs"] . '</span></div>'
        . '</div></div>';
    echo
    '<div class="panel panel-default"><div class="panel-heading">'
        . rex_i18n::msg('cm_slice_content')
        . '</div><div class="panel-body">';
}

$rex_values_settings = json_decode($slice->getValue(1), true);

$outputBuilder = new CM_OutputBuilder(
    $rex_values_settings[BootstrapColWidth::lg],
    $rex_values_settings[BootstrapColWidth::md],
    $rex_values_settings[BootstrapColWidth::sm],
    $rex_values_settings[BootstrapColWidth::xs]
);

$rex_values_content = json_decode($slice->getValue(2), true);

$htmlOutput = '';

$htmlOutput .= '<div class="slick-slider slick-slider-' . $rex_slice_id . '">';
foreach (explode(',', $rex_values_content["bilder"]) as $img) {
    if ($img !== "") {
        $medium = rex_media::get($img);
        $filename = '';
        if ($medium != null) {
            $medium->getTitle() != "" ? trim($medium->getTitle()) : $medium->getFileName();
        }
        $htmlOutput .= '<img class="img-fluid" src="/media/' . $img . '" alt="' . $filename . '">';
    }
}
$htmlOutput .= '</div>';

$htmlOutput .= '<script>
    window.onload=function() {
        try {
            $(".slick-slider-' . $rex_slice_id . '").css("max-height", (window.innerHeight - 72) + "px")

$(".slick-slider-' . $rex_slice_id . '").slick({';

if (isset($rex_values_content['infinity']) && $rex_values_content['infinity'] != '')
    $htmlOutput .= 'infinite: ' . $rex_values_content['infinity'] . ',';
else
    $htmlOutput .= 'infinite: false,';

if (isset($rex_values_content['dots']) && $rex_values_content['dots'] != '')
    $htmlOutput .= 'dots: ' . $rex_values_content['dots'] . ',';
else
    $htmlOutput .= 'dots: false,';

if (isset($rex_values_content['speed']) && $rex_values_content['speed'] != '')
    $htmlOutput .= $rex_values_content['speed'] != '' ? 'autoplay: true, speed: 500, autoplaySpeed: ' . $rex_values_content['speed'] . ',' : '';

if (isset($rex_values_content['arrows']) && $rex_values_content['arrows'] != '')
    $htmlOutput .= 'arrows: ' . $rex_values_content['arrows'] . ',';
else
    $htmlOutput .= 'arrows: false,';

if (isset($rex_values_content['fade']) && $rex_values_content['fade'] != '')
    $htmlOutput .= 'fade: ' . $rex_values_content['fade'] . ',';
else
    $htmlOutput .= 'fade: false,';

if (isset($rex_values_content['stop_on_mouseover']) && $rex_values_content['stop_on_mouseover'] != '')
    $htmlOutput .= 'pauseOnHover: ' . $rex_values_content['stop_on_mouseover'] . ',';
else
    $htmlOutput .= 'pauseOnHover: false, ';


$htmlOutput .= '});
} catch (e) {
console.log(e);
}
console.log("Slider");
};
</script>';

$outputBuilder->withFrontendOutput($htmlOutput);

echo $outputBuilder->build();

if (rex::isBackend()) {
    print(
    "
<link rel=\"stylesheet\" href=\"/assets/addons/redaxo_custom_components/frontend/slick-slider/slick.css\">
<link rel=\"stylesheet\" href=\"/assets/addons/redaxo_custom_components/frontend/slick-slider/slick-theme.css\">
<script src=\"/assets/addons/redaxo_custom_components/frontend/slick-slider/slick.min.js\"></script>");
}
