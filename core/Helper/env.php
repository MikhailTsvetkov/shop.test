<?php

/**
 * @param string $var
 * @param mixed $value
 *
 * @return mixed
 */
function env(string $var, mixed $value = null): mixed
{
    global $_APP_ENV;
    return $_APP_ENV->get($var, $value);
}
