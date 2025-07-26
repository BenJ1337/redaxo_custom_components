<?php
use redaxo_bootstrap\{ModuleManager};

$sliceId = -1;
if (null !== $this->sliceSql && $this->mode === 'add') {
    $sliceId = $this->getCurrentSlice()->getId();
}
echo (new ModuleManager($sliceId))->getInput('<p>Nothing to edit.</p>');
