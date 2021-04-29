<?php
class UmstrukturierungRexValue
{
    public static function getControls($itemId)
    {
        return
            '
            <div class="rcc-header">'
            . '<div class="rcc-btn-group">'
            . UmstrukturierungRexValue::addMoveItemUpBtn($itemId)
            . UmstrukturierungRexValue::addMoveItemDownBtn($itemId)
            . '</div>'
            . '<div class="rcc-btn-group">'
            . UmstrukturierungRexValue::addRemoveItemBtn($itemId)
            . '</div>'
            . '<div class="rcc-btn-group">'
            . UmstrukturierungRexValue::addNewItemBeforeBtn($itemId)
            . UmstrukturierungRexValue::addNewItemAfterBtn($itemId)
            . '</div></div>';
    }

    public static function addMoveItemDownBtn($itemId)
    {
        return '<button class="controle-btn"
            type="submit" 
            name="item-down" 
            title="DOWN"
            onclick="document.getElementsByName(\'save\')[0].value=0;"
            value="' . $itemId . '">
                <i style="color: #139df0" class="glyphicon glyphicon-chevron-down"></i>
            </button>';
    }

    public static function addMoveItemUpBtn($itemId)
    {
        return '<button class="controle-btn"
            type="submit" 
            name="item-up" 
            title="UP"
            onclick="document.getElementsByName(\'save\')[0].value=0;"
            value="' . $itemId . '">
                <i style="color: #139df0" class="glyphicon glyphicon-chevron-up"></i>
            </button>';
    }

    public static function addNewItemBeforeBtn($itemId)
    {
        return '<button class="controle-btn"
                type="submit" 
                title="New item before"
                name="item-new-before" 
                onclick="document.getElementsByName(\'save\')[0].value=0;"
                value="' . $itemId . '">
                    <i style="color: #1ff00d" class="glyphicon glyphicon-plus"></i> <span>&#11023;<span>
                </button>';
    }

    public static function addNewItemAfterBtn($itemId)
    {
        return '<button class="controle-btn"
                type="submit" 
                title="New item after"
                name="item-new-after" 
                onclick="document.getElementsByName(\'save\')[0].value=0;"
                value="' . $itemId . '">
                    <i style="color: #1ff00d" class="glyphicon glyphicon-plus"></i> <span>&#11022;</span>
                </button>';
    }

    public static function addRemoveItemBtn($itemId)
    {
        return '<button class="controle-btn"
                type="submit" 
                title="REMOVE"
                onclick="document.getElementsByName(\'save\')[0].value=0;"
                name="item-remove" 
                value="' . $itemId . '">
                    <i style="color: #ff2b2b" class="glyphicon glyphicon-trash"></i>
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
