<?php

use redaxo_eingabekomponenten\{Textarea};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->mode === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}
$textEingabe = new Textarea("JavaScript",  ['javascript'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($textEingabe->getHTML());
