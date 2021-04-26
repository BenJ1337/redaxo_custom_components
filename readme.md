# Custom Redaxo Modules

## Bildauswahl (Aktuell noch Änderung in mediapool.js notwendig (siehe Pull-Request))

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