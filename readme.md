# Neue Redaxo Komponenten

## Bildauswahl Komponente
 - Aktuell noch Änderung in mediapool.js notwendig (siehe Pull-Request)
 - Der Code für das Modul befindet sich im Addonverzeichnis 

Für die Nutzung ein neues Modul im Redaxo Backend anlegen und den eigentlichen Code des Module folgendermaßen referenzieren. 

### Input

    <?php
    $rex_slice_id = 'REX_SLICE_ID';
    $bild = 'REX_MEDIA[1]';
    include(rex_path::addon("redaxo_custom_components", "modules/bild/input.php"));

### Output

    <?php
    $rex_slice_id = 'REX_SLICE_ID';
    $bild = 'REX_MEDIA[1]';
    include(rex_path::addon("redaxo_custom_components", "modules/bild/output.php"));