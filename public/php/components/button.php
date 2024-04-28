<?php

/**
 * Render a button.
 * 
 * @param string | array $classStyles Class styles.
 * @param string $value Value of the button.
 */
function renderButton($classStyles, $value)
{
    $classStr = "btn ";
    if (gettype($classStyles) == "array") {
        foreach ($classStyles as $classStyle) {
            $classStr .= $classStyle . " ";
        }
    } else if (gettype($classStyles) == "string") {
        $classStr .= $classStyles;
    } else {
        throw new Exception("Type is not supported.");
    }

    echo '
    <div class="' . $classStr . '">
        ' . $value . '
    </div>
    ';
}