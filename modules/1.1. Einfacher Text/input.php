<?php

use redaxo_custom_components\{Inputfield};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->function === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}
$textEingabe = new Inputfield("Text",  ['text'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($textEingabe->getHTML());
