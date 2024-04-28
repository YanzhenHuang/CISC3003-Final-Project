<?php

/**
 * Turn an array to a string.
 * @param string | array $arr The input array to be transformed.
 */
function arrToStr($arr)
{
    $output_str = "";
    if (gettype($arr) == "array") {
        foreach ($arr as $item) {
            $output_str .= $item . " ";
        }
    } else if (gettype($arr) == "string") {
        $output_str .= $arr;
    } else {
        throw new Exception("Type is not supported.");
    }

    return $output_str;
}

/**
 * Render a button.
 * 
 * @param string | array $classStyles Class styles.
 * @param string | array | void $id The id attribute of the button.
 * @param string $value Value of the button.
 */
function renderButton($classStyles, $id = "", $value)
{
    $classStr = "btn " . arrToStr($classStyles);
    $idStr = arrToStr($id);

    echo '
    <div class="' . $classStr . '" id="' . $idStr . '">
        <div class="btn-text">
        ' . $value . '
        </div>
    </div>
    ';
}