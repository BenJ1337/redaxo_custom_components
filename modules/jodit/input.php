<?php
$sliceId = -1;
if (null !== $this->sliceSql) {
    $sliceId = $this->getCurrentSlice()->getId();
}
$bildauswahl = new WYSIWYGEditor("Text",  ['text'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($bildauswahl->getHTML());
