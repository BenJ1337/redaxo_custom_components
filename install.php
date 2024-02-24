<?php

use redaxo_custom_components\SyncService;

(new SyncService($this->getName()))->deleteAll();
(new SyncService($this->getName()))->copyModules();
