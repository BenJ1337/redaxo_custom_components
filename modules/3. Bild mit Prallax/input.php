<?php

use redaxo_custom_components\{WYSIWYGEditor, Bildauswahl, DropDown, CM_BootstrapFormBuilder};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;

if (null !== $this->sliceSql && $this->function === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}

$output = '';
$output .= new Bildauswahl("Bild", ['bild'], $sliceId, 2)->getHTML();

$dropDown = new DropDown('Höhe', ['hoehe'], $sliceId, 2, array(
                    "50" => "50",
                    "100" => "100",
                    "200" => "200",
                    "150" => "150",
                    "300" => "300",
                    "500" => "500",
                    "600" => "600"
));

$dropDown->setDefaultValue("200");
$output .= $dropDown->getHTML();

$output .= new WYSIWYGEditor("optionaler Text", ['wasiwyg_text'], $sliceId, 2)->getHTML();

echo (new ModuleManager($sliceId))->getInput($output);
?>