<?php
use redaxo_custom_components\{Textarea};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->mode === 'add') {
    $sliceId = $this->getCurrentSlice()->getId();
}
$textEingabe = new Textarea("Code",  ['code'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($textEingabe->getHTML());
