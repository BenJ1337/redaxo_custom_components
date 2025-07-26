<?php

use redaxo_custom_components\{Linkauswahl};
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->function === 'edit') {
    $sliceId = $this->getCurrentSlice()->getId();
}

$linkauswahl = new Linkauswahl(
                    "Verzeichnis mit Blog-Artikeln",
                    ['link'],
                    $sliceId,
                    2);

echo (new ModuleManager($sliceId))->getInput( $linkauswahl->getHTML());