<?php
$sliceId = -1;
if (null !== $this->sliceSql && $this->mode === 'add') {
    $sliceId = $this->getCurrentSlice()->getId();
}
$textEingabe = new Inputfield("Text",  ['text'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($textEingabe->getHTML());
