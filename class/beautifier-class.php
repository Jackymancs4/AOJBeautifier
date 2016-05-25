<?php

class Debug
{
    public $indent_size;
    public $colors = array(
        'Teal',
        'YellowGreen',
        'Tomato',
        'Navy',
        'MidnightBlue',
        'FireBrick',
        'DarkGreen',
        );

    public function __construct()
    {
        $this->indent_size = '20';
    }

    public function array_to_html($val)
    {
        $do_nothing = true;

        // Color counter
        $current = 0;

        // Split the string into character array
        $array = preg_split('//', $val, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($array as $char) {
            if ($char == '[') {
                if (!$do_nothing) {
                    echo '</div>';
                } else {
                    $do_nothing = false;
                }
            }
            if ($char == '[') {
                echo '<div>';
            }
            if ($char == ')') {
                echo '</div></div>';
                --$current;
            }

            echo $char;

            if ($char == '(') {
                echo "<div class='indent' style='padding-left: {$this->indent_size}px; color: ".($this->colors[$current % count($this->colors)]).";'>";
                $do_nothing = true;
                ++$current;
            }
        }
    }

    public function indent($json)
    {
        $result = '';
        $pos = 0;
        $strLen = strlen($json);
        $indentStr = '  ';
        $newLine = "\n";

        for ($i = 0; $i <= $strLen; ++$i) {

            // Grab the next character in the string
            $char = substr($json, $i, 1);

            // If this character is the end of an element,
            // output a new line and indent the next line
            if ($char == '}' || $char == ']') {
                $result .= $newLine;
                --$pos;
                for ($j = 0; $j < $pos; ++$j) {
                    $result .= $indentStr;
                }
            }

            // Add the character to the result string
            $result .= $char;

            // If the last character was the beginning of an element,
            // output a new line and indent the next line
            if ($char == ',' || $char == '{' || $char == '[') {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    ++$pos;
                }
                for ($j = 0; $j < $pos; ++$j) {
                    $result .= $indentStr;
                }
            }
        }

        return $result;
    }
}
