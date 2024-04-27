<?php

use redaxo_eingabekomponenten\{WYSIWYGEditor, Inputfield, Checkbox};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
$output = '';

if (null !== $this->sliceSql && $this->mode === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}

$farbe = new Inputfield("Hintergrund",  ['hintergrund'],  $sliceId, 2);
$farbe->setType(Inputfield::TYPE_COLOR);
$farbe->setDefaultValue('#FFFFFF');
$output .= $farbe->getHTML();

$deck = new Inputfield("Deckkraft",  ['deckkraft'],  $sliceId, 2);
$deck->setType(Inputfield::TYPE_RANGE);
$deck->setSettings(array("min" => "0", "max" => "100", "step" => "1"));
$deck->setDefaultValue(95);
$output .= $deck->getHTML();

$borderRadius = new Inputfield("Abgerundete Ecken",  ['borderRadius'],  $sliceId, 2);
$borderRadius->setType(Inputfield::TYPE_RANGE);
$borderRadius->setDefaultValue(0);
$borderRadius->setSettings(array("min" => "0", "max" => "100", "step" => "0.1"));
$output .= $borderRadius->getHTML();

$output .= '<div class="form-group">' . (new Checkbox(
    "Inhalt zentrieren",
    ["center"],
    $sliceId,
    1,
    'center'
))->getHTML() . '</div>';

$output .= (new WYSIWYGEditor("Text",  ['text'],  $sliceId, 2))->getHTML();
echo (new ModuleManager($sliceId))->getInput($output);
