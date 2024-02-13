<?php

use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql) {
    $sliceId = $this->getCurrentSlice()->getId();
}
$bildauswahl = new Bildauswahl("Bild",  ['bild'],  $sliceId, 2);
echo (new ModuleManager($sliceId))->getInput($bildauswahl->getHTML());
