<?php

use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->mode === 'add') {
    $sliceId = $this->getCurrentSlice()->getId();
}
$textEingabe = new Linkauswahl("Verlinkter Artikel",  ['link'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($textEingabe->getHTML());
