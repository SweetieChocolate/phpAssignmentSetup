<?php

function startsWith(string $string, string $startString) : bool
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function endsWith(string $string, string $endString) : bool
{
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}

?>