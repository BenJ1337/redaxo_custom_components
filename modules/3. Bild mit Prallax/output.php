<?php
use redaxo_bootstrap\{CM_OutputBuilder,BootstrapColWidth};

$rex_values_settings = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);

$outputBuilder = new CM_OutputBuilder(
    $rex_values_settings[BootstrapColWidth::lg],
    $rex_values_settings[BootstrapColWidth::md],
    $rex_values_settings[BootstrapColWidth::sm],
    $rex_values_settings[BootstrapColWidth::xs],
    $this->sliceId
);

$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(2), true);


if (isset($rex_values_content["bild"]) && $rex_values_content["bild"] != '') {
    $height = '200';
    if (isset($rex_values_content["hoehe"])) {
        $height = $rex_values_content["hoehe"];
    }
    $text = '';
    if (isset($rex_values_content["wasiwyg_text"])) {
        $text = $rex_values_content["wasiwyg_text"];
    }
    $textfarbe = '#000';
    if (isset($rex_values_content["textfarbe"])) {
        $textfarbe = $rex_values_content["textfarbe"];
    }
    $style = 'min-height: ' . $height . 'px; 
            background: url(/media/' . $rex_values_content["bild"] . ') no-repeat fixed; 
            background-size: cover;
            width: 100%;
            height: 100%;';

    $output = '';
    $output .= '<div class="parallax-text" style="' . $style . '">';
    if (!empty($text)) {
        $output .= '<style>.parallax-text h1,.parallax-text h2,.parallax-text h3,.parallax-text p {color:' . $textfarbe . ';}</style>';
        $output .= '<div style="display:inline-block;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    -ms-transform: translate(-50%,-50%);
                    transform: translate(-50%,-50%);">' . $text . '</div>';
    }
    $output .= '</div>';

    $outputBuilder->withFrontendOutput($output);
}

echo $outputBuilder->build();
