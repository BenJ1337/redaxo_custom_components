<?php

use redaxo_custom_components\{MehrfachBildauswahl, Inputfield, Checkbox};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;

if (null !== $this->sliceSql && $this->function === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}

$output = '';

$mehrfachbildauswahl = new MehrfachBildauswahl(
    "Bilder",
    ['bilder'],
    $sliceId,
    2
);
$output .=  $mehrfachbildauswahl->getHTML();
$slideSpeedInput = new Inputfield(
    "Anzeigedauer",
    ["speed"],
    $sliceId,
    2
);
$output .=  $slideSpeedInput->getHTML();

$checkbox = new Checkbox("Punkte", ["dots"], $sliceId, 2, 'true');
$output .=  $checkbox->getHTML();

$checkbox = new Checkbox("Unendliches Scrollen", ["infinity"], $sliceId, 2, 'true');
$output .=  $checkbox->getHTML();

$checkbox = new Checkbox("Pfeile",  ["arrows"], $sliceId, 2, 'true');
$output .=  $checkbox->getHTML();

$checkbox = new Checkbox("Verblassen-Effekt",  ["fade"], $sliceId, 2, 'true');
$output .=  $checkbox->getHTML();

$checkbox = new Checkbox("Stop bei Mouseover", ["stop_on_mouseover"], $sliceId, 2, 'true');
$output .=  $checkbox->getHTML();

echo (new ModuleManager($sliceId))->getInput($output);
