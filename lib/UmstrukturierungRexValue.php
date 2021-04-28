<?php
class UmstrukturierungRexValue
{
    public static function getControls($itemId)
    {
        return
            '
            <script>
                function dontSave() {
                    document.getElementsByName(\'save\')[0].value=0;
                }
            </script>
            <div 
            style="background: #555; padding: 5px; margin: 0 -5px 10px; display: inline-block; width: calc(100% + 10px);">'
            . '<div style="width: 33.3%; float: left;">'
            . UmstrukturierungRexValue::addMoveItemUpBtn($itemId)
            . UmstrukturierungRexValue::addMoveItemDownBtn($itemId)
            . '</div>'
            . '<div style="width: 33.3%; float: left;">'
            . UmstrukturierungRexValue::addRemoveItemBtn($itemId)
            . '</div>'
            . '<div style="width: 33.3%; float: left;">'
            . UmstrukturierungRexValue::addNewItemBeforeBtn($itemId)
            . UmstrukturierungRexValue::addNewItemAfterBtn($itemId)
            . '</div></div>'
            . '<style>
            .controle-btn {
                background: #222;
                color: #eee;
                border: none;
                padding: 3px 5px;
                margin-right: 5px;
            }
            .controle-btn:hover {
                background: #444;
                color: #fff;
            }
    </style>';
    }

    public static function addMoveItemDownBtn($itemId)
    {
        return '<button class="controle-btn"
            type="submit" 
            name="item-down" 
            title="DOWN"
            onclick="dontSave();"
            value="' . $itemId . '">
                <i style="color: #fff" class="glyphicon glyphicon-chevron-down"></i>
            </button>';
    }

    public static function addMoveItemUpBtn($itemId)
    {
        return '<button class="controle-btn"
            type="submit" 
            name="item-up" 
            title="UP"
            onclick="dontSave();"
            value="' . $itemId . '">
                <i style="color: #fff" class="glyphicon glyphicon-chevron-up"></i>
            </button>';
    }

    public static function addNewItemBeforeBtn($itemId)
    {
        return '<button class="controle-btn"
                type="submit" 
                title="New item before"
                name="item-new-before" 
                onclick="dontSave();"
                value="' . $itemId . '">
                    <i style="color: #fff" class="glyphicon glyphicon-plus"></i> Before
                </button>';
    }

    public static function addNewItemAfterBtn($itemId)
    {
        return '<button class="controle-btn"
                type="submit" 
                title="New item after"
                name="item-new-after" 
                onclick="dontSave();"
                value="' . $itemId . '">
                    <i style="color: #fff" class="glyphicon glyphicon-plus"></i> After
                </button>';
    }

    public static function addRemoveItemBtn($itemId)
    {
        return '<button class="controle-btn"
                type="submit" 
                title="REMOVE"
                onclick="dontSave();"
                name="item-remove" 
                value="' . $itemId . '">
                    <i style="color: #fff" class="glyphicon glyphicon-trash"></i>
                </button>';
    }

    public static function changeItems(&$rv, $wrapperId)
    {
        if ($rv == null) {
            return;
        }

        if (isset($_POST['item-remove'])) {
            UmstrukturierungRexValue::removeItem($rv, $wrapperId);
            return;
        }
        if (isset($_POST['item-new-before'])) {
            UmstrukturierungRexValue::addNewItemBefore($rv, $wrapperId);
            return;
        }
        if (isset($_POST['item-new-after'])) {
            UmstrukturierungRexValue::addNewItemAfter($rv, $wrapperId);
            return;
        }
        UmstrukturierungRexValue::move($rv, $wrapperId);
    }

    private static function removeItem(&$rv, $wrapperId)
    {
        if (sizeof($rv[$wrapperId]) > 1) {
            $index = $_POST['item-remove'];
            $newArray = array();
            $newIndex = 0;
            for ($i = 0; $i < sizeof($rv[$wrapperId]); $i++) {
                if ($i != $index) {
                    $newArray[$newIndex++] = $rv[$wrapperId][$i];
                }
            }
            $rv[$wrapperId] = $newArray;
        } else {
            echo '<div class="alert alert-danger">Mindestens ein Eintrag muss erhalen bleiben!</div>';
        }
    }

    private static function move(&$rv, $wrapperId)
    {
        $index = -1;
        $direction = 0;

        if (isset($_POST['item-up'])) {
            $index = $_POST['item-up'];
            $direction = -1;
        }
        if (isset($_POST['item-down'])) {
            $index = $_POST['item-down'];
            $direction = 1;
        }
        if ($index == 0 && $direction == -1) {
            echo '<div class="alert alert-danger">Verschieben nach oben nicht möglich</div>';
            return;
        }
        if ($index == sizeof($rv[$wrapperId]) - 1 && $direction == 1) {
            echo '<div class="alert alert-danger">Verschieben nach unten nicht möglich</div>';
            return;
        }
        if ($index == -1 || $direction == 0) {
            return;
        }

        $tmp = $rv[$wrapperId][$index];
        $rv[$wrapperId][$index] = $rv[$wrapperId][$index + $direction];
        $rv[$wrapperId][$index + $direction] = $tmp;
    }

    private static function addNewItemAfter(&$rv, $wrapperId)
    {
        $index = $_POST['item-new-after'];
        $newArray = array();
        $newIndex = 0;
        for ($i = 0; $i < sizeof($rv[$wrapperId]); $i++) {
            if ($i != $index) {
                $newArray[$newIndex] = $rv[$wrapperId][$i];
            } else {
                $newArray[$newIndex] = $rv[$wrapperId][$i];
                $newArray[++$newIndex] = null;
            }
            $newIndex++;
        }
        $rv[$wrapperId] = $newArray;
    }

    private static function addNewItemBefore(&$rv, $wrapperId)
    {
        $index = $_POST['item-new-before'];
        $newArray = array();
        $newIndex = 0;
        for ($i = 0; $i < sizeof($rv[$wrapperId]); $i++) {
            if ($i != $index) {
                $newArray[$newIndex] = $rv[$wrapperId][$i];
            } else {
                $newArray[$newIndex] = null;
                $newArray[++$newIndex] = $rv[$wrapperId][$i];
            }
            $newIndex++;
        }
        $rv[$wrapperId] = $newArray;
    }
}
