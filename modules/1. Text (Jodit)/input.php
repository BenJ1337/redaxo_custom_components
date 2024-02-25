<?php

use redaxo_eingabekomponenten\{WYSIWYGEditor, Inputfield, Checkbox};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
$output = '';

$deckkraft = '95';
$borderRadiusValue = '0';

if (null !== $this->sliceSql && $this->mode === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
    $rex_values_content = json_decode($this->getCurrentSlice()->getValue(2), true);
    if (isset($rex_values_content["deckkraft"])) {
        $deckkraft = $rex_values_content["deckkraft"];
    }
    if (isset($rex_values_content["borderRadius"])) {
        $borderRadiusValue = $rex_values_content["borderRadius"];
    }
}

$farbe = new Inputfield("Hintergrund",  ['hintergrund'],  $sliceId, 2);
$farbe->setType('color');
$output .= $farbe->getHTML();

$deck = new Inputfield("Deckkraft",  ['deckkraft'],  $sliceId, 2);
$deck->setType('range');
$deck->setSettings(array("min" => "0", "max" => "100", "value" => $deckkraft, "step" => "1"));
$output .=   $deck->getHTML();

$borderRadius = new Inputfield("Abgerundete Ecken",  ['borderRadius'],  $sliceId, 2);
$borderRadius->setType('range');
$borderRadius->setSettings(array("min" => "0", "max" => "100", "value" => $borderRadiusValue, "step" => "0.1"));
$output .=   $borderRadius->getHTML();

$output .= '<div class="form-group">' . (new Checkbox(
    "Inhalt zentrieren",
    ["center"],
    $sliceId,
    1,
    'center'
))->getHTML() . '</div>';

$output .= (new WYSIWYGEditor("Text",  ['text'],  $sliceId, 2))->getHTML();
echo (new ModuleManager($sliceId))->getInput($output);
