<?php
$sliceId = -1;
$output = '';

$deckkraft = '95';

if (null !== $this->sliceSql && $this->mode === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
    $rex_values_content = json_decode($this->getCurrentSlice()->getValue(2), true);
    if (isset($rex_values_content["deckkraft"])) {
        $deckkraft = $rex_values_content["deckkraft"];
    }
}

$farbe = new Inputfield("Hintergrund",  ['hintergrund'],  $sliceId, 2);
$farbe->setType('color');
$output .= $farbe->getHTML();

$deck = new Inputfield("Deckkraft",  ['deckkraft'],  $sliceId, 2);
$deck->setType('range');
$deck->setSettings(array("min" => "0", "max" => "100", "value" => $deckkraft, "step" => "1"));

$output .=   $deck->getHTML();
$output .= (new WYSIWYGEditor("Text",  ['text'],  $sliceId, 2))->getHTML();
echo (new ModuleManager($sliceId))->getInput($output);
