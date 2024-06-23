<?php

/**
 * @param string $name
 * @param array $_VARS
 *
 * @return void
 */
function layout(string $name, array $_VARS = []): void
{
    extract($_VARS);
    include 'resources'
        . DIRECTORY_SEPARATOR . 'views'
        . DIRECTORY_SEPARATOR . 'layouts'
        . DIRECTORY_SEPARATOR . $name . '.php';
}
