<?php
$bildauswahl = new Bildauswahl("Bild",  ['bild'],  $this->slice_id, 2);
echo (new ModuleManager($this->slice_id))->getInput($bildauswahl->getHTML());
