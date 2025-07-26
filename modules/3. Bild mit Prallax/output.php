<?php

use redaxo_bootstrap\{ModuleManager};

$this->getContentAsQuery(true);
$slice = rex_article_slice::getArticleSliceById($this->getCurrentSlice()->getId());
if (null !== $slice) {
    $rex_values_content = json_decode($slice->getValue(2), true);
    if (isset($rex_values_content["bild"]) && $rex_values_content["bild"] != '') {
        $alt = $rex_values_content["bild"];

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
                            top: '.$height.'px;
                            left: 50%;
                            -ms-transform: translate(-50%,-50%);
                            transform: translate(-50%,-50%);">' . $text . '</div>';
            }
            $output .= '</div>';
            echo (new ModuleManager($this->getCurrentSlice()->getId()))->getOutput($output);
        }
    }
}