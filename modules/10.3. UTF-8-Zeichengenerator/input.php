<?php

use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql) {
    $sliceId = $this->getCurrentSlice()->getId();
}
echo (new ModuleManager($sliceId))->getInput("");
